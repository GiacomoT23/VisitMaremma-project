<?php
	require_once __DIR__ . "/../config.php";
    require_once DIR_UTIL . "sessionUtil.php";
	require_once DIR_UTIL . "placeManagerDb.php";	
	require_once DIR_LAYOUT . "messageUtil.php";
	
	
	function showProfile($result){
		$numAccount = mysqli_num_rows($result);
		if($numAccount != 1) { 
			showError();	
			return;
		}
		
		$accountRow = $result->fetch_assoc();
		$nVisitedResult = countVisited($_SESSION['nome_utente']);
		$nToVisitResult = countToVisit($_SESSION['nome_utente']);

		$nVisitedRow = $nVisitedResult->fetch_assoc();
		$nToVisitRow = $nToVisitResult->fetch_assoc();
		
		echo '<div id = "account_tab">';
		
		echo '<div class = "row">';
		echo 	'<div class = "col_1">';
		echo 		'<span class="profile_attributes">Nome Utente:</span> '; 
		echo 	'</div>';
		echo	'<div class = "col_2">';
		echo		 $accountRow['nome_utente'];
		echo 	'</div>';
		echo '</div>';
		echo '<div class = "row">';
		echo 	'<div class = "col_1">';
		echo 		'<span class="profile_attributes">Email:</span>';
		echo 	'</div>';
		echo	'<div class = "col_2">';
		echo		 $accountRow['email'];
		echo 	'</div>';
		echo '</div>';
		echo '<div class = "row">';
		echo 	'<div class = "col_1">';
		echo 		'<span class="profile_attributes">Nome:</span>';
		echo	'</div>';
		echo	'<div class = "col_2">';
		echo		 $accountRow['nome'];
		echo 	'</div>';
		echo '</div>';
		echo '<div class = "row">';
		echo 	'<div class = "col_1">';
		echo 		'<span class="profile_attributes">Cognome:</span>';
		echo	'</div>';
		echo	'<div class = "col_2">';
		echo		 $accountRow['cognome'];
		echo 	'</div>';
		echo '</div>';
		echo '<div class="row">';
		echo 	'<h3>Campi opzionali</h3>';
		echo '</div>';
		echo '<div class = "row">';
		echo 	'<div class = "col_1">';
		//echo '<span class="profile_attributes">Sesso</span>: ' . $accountRow['sesso'] . '<br>';
		echo 		'<span class="profile_attributes">Comune:</span>';
		echo	'</div>';
		echo	'<div class = "col_2">';
		echo		 $accountRow['comune'];
		echo 	'</div>';
		echo '</div>';
		echo '<div class = "row">';
		echo 	'<div class = "col_1">';
		echo 		'<span class="profile_attributes">Telefono:</span>';
		echo	'</div>';
		echo	'<div class = "col_2">';
		echo		 $accountRow['telefono'];
		echo 	'</div>';
		echo '</div>';
		echo '<div class = "row">';
		echo	'<div class = "col_1">';
		echo		'<a class = "a_profile" href = "modifica_opzionali.php">Modifica opzionali</a>';
		echo	'</div>';
		echo '</div><br>';
		echo '<div class = "row">';
		echo 	'<div class = "col_1">';
		echo 		'<a class="a_profile" href="visitati.php">Luoghi visitati:</a>';
		echo	'</div>';
		echo	'<div class = "col_2">';
		echo		 $nVisitedRow['COUNT(*)'];
		echo 	'</div>';
		echo '</div>';
		echo '<div class = "row">';
		echo 	'<div class = "col_1">';
		echo 		'<a class="a_profile" href="daVisitare.php">Luoghi da visitare:</a>';
		echo	'</div>';
		echo	'<div class = "col_2">';
		echo		 $nToVisitRow['COUNT(*)'];
		echo 	'</div>';
		echo '</div>';

		echo '</div>';
		}
?>