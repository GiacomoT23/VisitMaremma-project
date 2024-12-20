<?php
	session_start();
	
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "placeManagerDb.php";
	require_once DIR_UTIL . "sessionUtil.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";
	
	$response = new AjaxResponse();
	
	if (!isset($_POST['rating']) || !isset($_POST['nomeLuogo'])){
		echo json_encode($response);
		return;
	}
	
	$rating = $_POST["rating"];
	$review = $_POST["review"];
	$nomeLuogo = $_POST["nomeLuogo"];
	
	$result1 = getPreviousReview($nomeLuogo, $_SESSION["nome_utente"]);
	
	if (!checkEmptyResult($result1)){
		removeReview($nomeLuogo, $_SESSION["nome_utente"]);
	}
	
	insertReview($nomeLuogo, $_SESSION["nome_utente"], $rating, $review);
	
	$reviewToLoad = $_POST['reviewToLoad'];
	
	$result2 = getAllReviews($nomeLuogo, 0, $reviewToLoad);
	
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