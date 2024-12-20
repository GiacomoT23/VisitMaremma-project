<?php
	session_start();
	
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "placeManagerDb.php";
	require_once DIR_UTIL . "sessionUtil.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";
	
	$response = new AjaxResponse();
	
	if (!isset($_GET['nomeUtente'])||!isset($_GET['usersToLoad']) || !isset($_GET['offset'])){
		echo json_encode($response);
		return;
	}
	
	$nomeUtente = $_GET["nomeUtente"];
	$usersToLoad = $_GET['usersToLoad'];
	$offset = $_GET['offset'];


	removeUser($nomeUtente);
	removeUserReviews($nomeUtente);
	removeUserLists($nomeUtente);
	
	$result2 = getAllUsers($offset, $usersToLoad);
	

	
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
		$message = "No more users to load";
		return new AjaxResponse("-1", $message);
	}
	
	function setResponse($result, $message){
		$response = new AjaxResponse("0", $message);
			
		$index = 0;
		while ($row = $result->fetch_assoc()){
			
			// Set user class
			$user = new User();
			$user->nomeUtente = $row['nome_utente'];
			$user->email = $row['email'];
			$user->nome = $row['nome'];
			$user->cognome = $row['cognome'];
			$user->telefono = $row['telefono'];
			$user->comune = $row['comune'];
		
			$response->data[$index] = $user;
			$index++;
		}
		
		return $response;
	}

?>

