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
		<script  src="./../js/ajax/UserLoader.js"></script>
		<script  src="./../js/ajax/UserDashboard.js"></script>
		<script  src="./../js/ajax/UserEventHandler.js"></script>
		<meta name="viewport" content="width=device-width">

		<title>Amministratore - Cerca</title>
	</head>
	
	<?php
		$searchType = 1;
		echo '<body onload="UserLoader.init(' . $searchType . ');" style="	background-color: rgb(255,255,140);">';
		include DIR_LAYOUT . "menuAdmin.php";
	
		echo '<div id="div_barra_ricerca" >';
		echo '<input id="input_cerca" type="text" placeholder="Cerca utenti" onkeyup="UserLoader.search(this.value ,' . 1 . ')" >';
		echo '</div>';
		include DIR_LAYOUT . "navigation_page_users.php";

		echo '<div id="userDashboard" class="user_dashboard"></div>';		// Fill dinamically with Ajax Request 
		
		include DIR_LAYOUT . "navigation_page_users.php";
					
	?>
	
	<script >
		document.getElementById("cerca_link").setAttribute("class", "selected_link");
	</script>
	
	</body>
</html>