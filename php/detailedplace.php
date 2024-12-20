<?php
	require_once __DIR__ . "/config.php";
	session_start();
    include DIR_UTIL . "sessionUtil.php";
	include DIR_LAYOUT . "places_dashboard.php";
	require_once DIR_UTIL . "placeManagerDb.php";
    
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
    	<meta name = "author" content = "PWEB">
		<link rel="stylesheet" href="./../css/menu.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/esploraLaMaremma.css" type="text/css" media="screen">
   	 	<link rel="shortcut icon" type="image/x-icon" href="./../css/img/favicon.ico" />
		<script  src="./../js/ajax/ajaxManager.js"></script>	
		<script  src="./../js/ajax/ReviewLoader.js"></script>
		<script  src="./../js/ajax/ReviewDashboard.js"></script>
		<script  src="./../js/ajax/ReviewEventHandler.js"></script>	
		<script  src="./../js/review.js"></script>	
		<meta name="viewport" content="width=device-width">		
		
		<title>ViviLaMaremma - Luoghi</title>
	</head>
	<?php
		
		$nome = $_GET['nome_luogo'];

		echo '<body onload = "ReviewLoader.loadData(\'' . $nome . '\', '  . isAdmin() . ')" style="	background-color: rgb(255,255,140);">';
		
		if (isAdmin()==1){
			include DIR_LAYOUT . "menuAdmin.php";
		}
		else{
			include DIR_LAYOUT . "menu.php";	
		}
			
		$result = getPlaceByName($nome);	
		showDetailedPlace($result);
		include DIR_LAYOUT . "footer.php";
		?>
	</body>
</html>