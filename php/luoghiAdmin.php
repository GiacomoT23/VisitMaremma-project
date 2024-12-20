<?php
	require_once __DIR__ . "/config.php";
	session_start();
    include DIR_UTIL . "sessionUtil.php";
	
	if (!isAdmin()){
		header('Location: ./../index.php');
		exit;
    }

?>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
    	<meta name = "author" content = "PWEB">
		<link rel="stylesheet" href="./../css/menu.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/esploraLaMaremma.css" type="text/css" media="screen">
   	 	<link rel="shortcut icon" type="image/x-icon" href="./../css/img/favicon.ico" />
		<script  src="./../js/ajax/ajaxManager.js"></script>	
		<script  src="./../js/ajax/PlaceLoader.js"></script>
		<script  src="./../js/ajax/PlaceDashboard.js"></script>
		<script  src="./../js/ajax/UserPlaceEventHandler.js"></script>	
		<meta name="viewport" content="width=device-width">
		<title>Amministratore - Luoghi</title>
	</head>
	
	<?php
		$searchType = 0;
		$admin = isAdmin();
		$logged = isLogged2();
		echo '<body onload="PlaceLoader.init(' . $searchType . '); ';
		echo 'PlaceLoader.loadData(' . $searchType . ',' . $admin . ', ' . $logged . ')" style="	background-color: rgb(255,255,140);">'; 

		include DIR_LAYOUT . "menuAdmin.php";
			
	?>
	
	
	<?php	
					
		
		echo '<a href="aggiungiLuogo.php"> <div id="aggiungi"></div> </a>';
		
		include DIR_LAYOUT . "navigation_page.php";
		
		echo '<div id="placeDashboard" class="place_dashboard"></div>'; // Fill dinamically with Ajax Request 
			
		include DIR_LAYOUT . "navigation_page.php";
		include DIR_LAYOUT . "footer.php";
			
	?>
	
	</body>
</html>