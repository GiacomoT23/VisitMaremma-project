<?php
	session_start();
	
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "placeManagerDb.php";
	require_once DIR_UTIL . "sessionUtil.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";
	
	$response = new AjaxResponse();
	
	if (!isset($_GET['nomeLuogo'])||!isset($_GET['placeToLoad']) || !isset($_GET['offset'])){
		echo json_encode($response);
		return;
	}
	
	$nomeLuogo = $_GET["nomeLuogo"];
	$placeToLoad = $_GET['placeToLoad'];
	$offset = $_GET['offset'];

	$result3 = getPlaceByName($nomeLuogo);
	$row = $result3->fetch_assoc();
	$url = $row['poster'];
	$url = '../' . $url ;
	unlink($url);
	

	removePlace($nomeLuogo);
	remove_reviews_luogo($nomeLuogo);
	remove_liste_luogo($nomeLuogo);
	
	$result2 = getAllPlaces($offset, $placeToLoad);
	

	
	if (checkEmptyResult($result2)){
		$response = setEmptyResponse();
		echo json_encode($response);
		return;
	}
	
	$message = "OK";
	$response = setResponse($result2, $message);
	echo json_encode($response);
	return;
	
	function checkEmptyResult($result){
		if ($result === null || !$result)
			return true;
			
		return ($result->num_rows <= 0);
	}
	
	function setEmptyResponse(){
		$message = "No more places to load";
		return new AjaxResponse("-1", $message);
	}
	
	function setResponse($result, $message){
		$response = new AjaxResponse("0", $message);
			
		$index = 0;
		while ($row = $result->fetch_assoc()){
			// Set UserStat class
			$userStat = new UserStat();
			
			if(!isLogged()){
				$userStat->visitato = 0;
				$userStat->daVisitare = 0;
			}
			else{
				$userPlaceResult = getUserPlaceStat($_SESSION['nome_utente'], $row['nome_luogo']);
				if ($userPlaceRow = $userPlaceResult->fetch_assoc()){
					$userStat->visitato = $userPlaceRow['visitato'];
					$userStat->daVisitare = $userPlaceRow['da_visitare'];
				}
			}
			
			// Set place class
			$place = new Place();
			$place->nome = $row['nome_luogo'];
			$place->posterUrl = $row['poster'];
			$place->comune = $row['comune'];
			$place->mare = $row['mare'];
			$place->montagna = $row['montagnaCollina'];
			$place->storia = $row['storiaArcheologia'];
			$place->parco = $row['parcoRiserva'];

			// Set placeUserStat class		
			$placeUserStat = new PlaceUserStat($place, $userStat);
		
			$response->data[$index] = $placeUserStat;
			$index++;
		}
		
		return $response;
	}

?>