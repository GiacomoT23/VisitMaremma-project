<?php
	session_start();
	
	require_once __DIR__ . "./../config.php";
	require_once DIR_UTIL . "placeManagerDb.php";
	require_once DIR_UTIL . "sessionUtil.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";
	
	$response = new AjaxResponse();
	
	if (!isset($_GET['pattern'])||!isset($_GET['placeToLoad'])||!isset($_GET['offset'])){
		echo json_encode($response);
		return;
	}		
	
	$pattern = $_GET['pattern'];
	$placeToLoad = $_GET['placeToLoad'];
	$offset = $_GET['offset'];

	$result = getSearchPlacesByName($pattern, $placeToLoad, $offset);
	
	if (checkEmptyResult($result)){
		$response = setEmptyResponse();
		echo json_encode($response);
		return;
	}
	
	$message = "OK";	
	$response = setResponse($result, $message);
	echo json_encode($response);
	return;
	
	function checkEmptyResult($result){
		if ($result === null || !$result)
			return true;
			
		return ($result->num_rows <= 0);
	}
	
	function setEmptyResponse(){
		$message = "No more movies to load";
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
			
			
			// Set Place class
			$place = new Place();
			$place->nome = $row['nome_luogo'];
			$place->posterUrl = $row['poster'];
			$place->comune = $row['comune'];
			$place->mare = $row['mare'];
			$place->montagna = $row['montagnaCollina'];
			$place->storia = $row['storiaArcheologia'];
			$place->parco = $row['parcoRiserva'];

			// Set PlaceUserStat class		
			$placeUserStat = new PlaceUserStat($place, $userStat);
		
			$response->data[$index] = $placeUserStat;
			$index++;
		}
		
		return $response;
	}
	
?>