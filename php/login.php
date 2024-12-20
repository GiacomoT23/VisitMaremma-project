<?php
	require_once __DIR__ . "/config.php";
    require_once DIR_UTIL . "esploraLaMaremmaDbManager.php"; //includes Database Class
    require_once DIR_UTIL . "sessionUtil.php"; //includes session login
 
	$nome_utente = $_POST['nome_utente'];
	$password = $_POST['password'];
	
	$errorMessage = login($nome_utente, $password);
	if($errorMessage === null){
		if($_SESSION['amministratore']== 1)
			header('location: ./luoghiAdmin.php');
		else
			header('location: ./home.php');
	}
	else
		header('location: ./../index.php?errorMessage=' . $errorMessage );


	function login($nome_utente, $password){   
		if ($nome_utente != null && $password != null){
			$userId = authenticate($nome_utente, $password);
    		if ($userId > 0){
    			session_start();
    			setSession($nome_utente);
				$result = searchAdmin($nome_utente);
				if(!checkEmptyResult($result))
					setAdmin();
    			return null;
    		}

    	} else
    		return 'You should insert something';
    	
    	return 'nome_utente and password not valid.';
	}
	
	function authenticate ($nome_utente, $password){   
		global $esploraLaMaremmaDb;
		$nome_utente = $esploraLaMaremmaDb->sqlInjectionFilter($nome_utente);
		$password = $esploraLaMaremmaDb->sqlInjectionFilter($password);

		$queryText = "select * from account where nome_utente= '" . $nome_utente . "' AND password='" . $password . "'";

		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$numRow = mysqli_num_rows($result);
		if ($numRow != 1)
			return -1;
		
		$esploraLaMaremmaDb->closeConnection();
		$accountRow = $result->fetch_assoc();
		$esploraLaMaremmaDb->closeConnection();
		return 1;
	}
	
	function searchAdmin($nome_utente){
		global $esploraLaMaremmaDb;
		$nome_utente = $esploraLaMaremmaDb->sqlInjectionFilter($nome_utente);
		$queryText = "select * from account where nome_utente='" . $nome_utente . "' AND amministratore = 1";
		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result;
	}
	
	function checkEmptyResult($result){
		if ($result === null || !$result)
			return true;
			
		return ($result->num_rows <= 0);
	}
?>