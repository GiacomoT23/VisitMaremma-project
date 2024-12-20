<?php
	session_start();
	
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "placeManagerDb.php";
	require_once DIR_UTIL . "sessionUtil.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";
	
	$response = new AjaxResponse();
	
	if (!isset($_GET['nomeLuogo']) ||!isset($_GET['reviewToLoad']) || !isset($_GET['offset'])){
		echo json_encode($response);
		return;
	}	
	
	$nomeLuogo = $_GET['nomeLuogo'];
	$reviewToLoad = $_GET['reviewToLoad'];
	$offset = $_GET['offset'];
	
	$result = getAllReviews($nomeLuogo, $offset, $reviewToLoad);
	
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
		$message = "No more reviews to load";
		return new AjaxResponse("-1", $message);
	}
	
	function setResponse($result, $message){
		$response = new AjaxResponse("0", $message);
			
		$index = 0;
		while ($row = $result->fetch_assoc()){
			
			// Set review class
			$review = new Review();
			$review->nomeLuogo = $row['nome_luogo'];
			$review->nomeUtente = $row['nome_utente'];
			$review->valutazione = $row['valutazione'];
			$review->recensione = $row['recensione'];
			$review->istante = $row['istante'];
		
			$response->data[$index] = $review;
			$index++;
		}
		
		return $response;
	}

?>