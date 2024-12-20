<?php
	session_start();
	
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "placeManagerDb.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";
	
	$response = new AjaxResponse();
	$message = "OK";
	
	$nome = null;
	if (!isset($_GET['nome'])){
		echo json_encode($response);
		return;
	}		
	
	$nome = $_GET['nome'];
	
	$currentFlag = 0;	
	// check isVisited flag
	if (isset($_GET['isVisited'])){
		$currentFlag = $_GET['isVisited'];
		if (setVisitedUserStat($nome, $currentFlag))
			$response = setCorrectResponse($nome, $message);
				
		echo json_encode($response);
		return;
	}	
	
		// check toVisit flag
	if (isset($_GET['toVisit'])){
		$currentFlag = $_GET['toVisit'];
		if (setToVisitUserStat($nome, $currentFlag, $response))
			$response = setCorrectResponse($nome, $message);
		
		echo json_encode($response);
		return;
	}	
		
		
	
	
	
	
	
	function isUserPlaceStatInDb($nome, $nome_utente){
		$result = getUserPlaceStat($nome_utente, $nome);
		$numRows = $result->num_rows;
		return $numRows === 1;
	}		
		
	function setVisitedUserStat($nome, $isVisitedFlag){
	if(isUserPlaceStatInDb($nome, $_SESSION['nome_utente']))
		$result = updateVisitedUserPlaceStat($nome, $_SESSION['nome_utente'], $isVisitedFlag);
	else
		$result = insertVisitedUserPlaceStat($nome, $_SESSION['nome_utente'], $isVisitedFlag);
	
	return $result;
	}
	
	function setToVisitUserStat($nome, $toVisitFlag, $response){
		if(isUserPlaceStatInDb($nome, $_SESSION['nome_utente'])) {
			$result = updateToVisitUserPlaceStat($nome, $_SESSION['nome_utente'], $toVisitFlag, $response);
			}
		else{
			$result = insertToVisitUserPlaceStat($nome, $_SESSION['nome_utente'], $toVisitFlag);
			}
		
		return $result;
	}
	
	function setCorrectResponse($nome, $message){
		$response = new AjaxResponse("0", $message);
		$result = getUserPlaceStat($_SESSION['nome_utente'], $nome);
		$userPlaceRow = $result->fetch_assoc();
		
		// Set UserStat class
		$userStat = new UserStat();
		$userStat->visitato = $userPlaceRow['visitato'];
		$userStat->daVisitare = $userPlaceRow['da_visitare'];
		
		// Set Place class
		$place = new Place();
		$place->nome = $nome;

		// Set PlaceUserStat class		
		$placeUserStat = new PlaceUserStat($place, $userStat);
		
		$response->data = $placeUserStat;
		
		return $response;
	}

?>