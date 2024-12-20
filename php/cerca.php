<?php
	session_start();
    require_once __DIR__ . "/config.php";
    include DIR_UTIL . "sessionUtil.php";
	if (isAdmin()){
		header('Location: ./luoghiAdmin.php');
		exit;
    }
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
    	<meta name = "author" content = "PWEB">
    	<meta name = "keywords" content = "game">
		<link rel="stylesheet" href="./../css/menu.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/esploraLaMaremma.css" type="text/css" media="screen">
   	 	<link rel="shortcut icon" type="image/x-icon" href="./../css/img/favicon.ico" />
		<script  src="./../js/ajax/ajaxManager.js"></script>	
		<script  src="./../js/ajax/UserPlaceEventHandler.js"></script>	
		<script  src="./../js/ajax/PlaceLoader.js"></script>
		<script  src="./../js/ajax/PlaceDashboard.js"></script>
		<meta name="viewport" content="width=device-width">
		<title>EsploraLaMaremma - Home</title>
	</head>
	
	<?php
		$searchType = 7;
		$admin = isAdmin();
		$logged = isLogged2();


		echo '<body onload="PlaceLoader.init(' . $searchType . ')" style="	background-color: rgb(255,255,140);">';
		include DIR_LAYOUT . "menu.php";
	
		echo '<div id="div_barra_ricerca">';
		echo '<input id="input_cerca" type="text" placeholder="Cerca dei luoghi" onkeyup="PlaceLoader.search(this.value, ' . 1 . ')">';
		echo '</div>';
		include DIR_LAYOUT . "navigation_page.php";
		echo '<div id="placeDashboard" class="place_dashboard"></div>'; // Fill dinamically with Ajax Request 
		include DIR_LAYOUT . "navigation_page.php";
	?>
	
	<script >
		document.getElementById("cerca_link").setAttribute("class", "selected_link");
	</script>
	
	</body>
</html>
