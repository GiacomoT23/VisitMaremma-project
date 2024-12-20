<?php
	require_once __DIR__ . "/../config.php";
    require_once DIR_UTIL . "sessionUtil.php";
	require_once DIR_UTIL . "placeManagerDb.php";	
	require_once DIR_LAYOUT . "messageUtil.php";
	
	
	function showDetailedPlace($result){
		$numPlaces = mysqli_num_rows($result);
		if($numPlaces != 1) { 
			showError();	
			return;
		}
		
		$placeRow = $result->fetch_assoc();
		$luogo = str_replace("_", " ", $placeRow['nome_luogo']);
				
		//echo '<div id="detailed_place_tab">';
		echo '<div id="titolo"><h1>' . $luogo . '</h1> <h2> (Comune: ' . $placeRow['comune'] . ')</h2></div>';
		
		echo '<div id="img_loc">';
		echo 	'<div id="detailed_img_container" >';
		//echo 		'<img  id="img_size" src="../img/trasparente.png" alt="immagine luogo">';
		echo 		'<img id="img_vera" src="' . $placeRow['poster'] . '" alt="immagine luogo">';
		echo 	'</div>';
		echo 	'<div id="detailed_loc_container">';
		echo 		'<iframe id="detailed_loc" title = "Localizzazione" src="' . $placeRow['localizzazione'] . '"> </iframe>';
		echo 	'</div>';
		echo '</div>';
		
		echo '<hr>';
		
		echo'<h2 class="detailed_h2">Perche\' visitarlo</h2>';
		
		echo'<div id="detailed_description_container">' . $placeRow['descrizione'] . '</div>';
		
		echo '<hr>';
		
		echo '<h2 class="detailed_h2">Recensioni</h2>';
		echo '<div id="reviewDashboard"></div>'; //riempito in ajax
		
		if(isset($_SESSION["nome_utente"]) && isAdmin()==0){
			$previousReview = getPreviousReview($placeRow['nome_luogo'], $_SESSION["nome_utente"]);		
			echo 	'<h2 class="detailed_h2">Valuta anche tu</h3>';
			echo '<div id="Rating">';
			echo	'<div class="div_textarea">';
			echo		'<h3>La tua recensione</h3>';			
			echo 		'<textarea name="bo" rows="7" cols="30" id="my_review" onkeyup="ContaCaratteri()"></textarea>';
			echo 		'<input type="text" id="counter" size="2" value="1000" readonly="readonly">';
			echo 		'<p id="review_message"></p>';
			echo	'</div>';
			echo	'<div class="div_voto">';
			echo		'<h3>Il tuo voto</h3>';	
			echo 		'<label for="quantity">Voto (tra 1 e 5):</label>';
			echo 		'<input type="number" id="quantity" name="quantity" min="1" max="5" step="0.5" value="5">';
			echo 	'</div>';
			echo '</div>';

			$result1 = getPreviousReview($placeRow['nome_luogo'], $_SESSION["nome_utente"]);
			if (!checkEmptyResult($result1))
				echo '<p id="warning_review">Luogo gi&agrave recensito, un\'altra recensione sovrascriver&agrave quella precedente</p>';
			echo '<div class="div_button">';		
			echo 	'<button id="review_button" onclick="ReviewEventHandler.onReviewEvent(\'' . $placeRow['nome_luogo'] . '\')">Invia</button>';
			echo '</div>';
		}else if(!isset($_SESSION["nome_utente"])){
			echo '<h2 class="detailed_h2">Per rillasciare una recensione devi essere loggato, accedi <a href= "../index.php">qui</a></h2>';
		}
		
		
	}
	
	function checkEmptyResult($result){
		if ($result === null || !$result)
			return true;
			
		return ($result->num_rows <= 0);
	}
?>