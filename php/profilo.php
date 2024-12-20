<?php
	require_once __DIR__ . "/config.php";
	session_start();
    include DIR_UTIL . "sessionUtil.php";
    
    if (!isLogged()){
		    header('Location: ./../index.php');
		    exit;
    }	
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
		<link rel="stylesheet" href="./../css/menu.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/esploraLaMaremma.css" type="text/css" media="screen">
   	 	<link rel="shortcut icon" type="image/x-icon" href="./../css/img/favicon.ico" />
		<script  src="./../js/ajax/ajaxManager.js"></script>	
		<script  src="./../js/ajax/UserPlaceEventHandler.js"></script>	
		<script  src="./../js/ajax/PlaceLoader.js"></script>
		<script  src="./../js/ajax/PlaceDashboard.js"></script>		
		<meta name="viewport" content="width=device-width">
		<title>EsploraLaMaremma - Profilo</title>
	</head>
	<body style="background-Image: url('../img/registrazione.jpg');
				background-repeat: no-repeat;
				background-attachment: fixed;
				background-size: 100% 100%;">
		
		<?php
			include DIR_LAYOUT . "menu.php";
			include DIR_LAYOUT . "profile_dashboard.php";
			require_once DIR_UTIL . "placeManagerDb.php";	

			$nome = $_SESSION['nome_utente'];
			$result = getAccountByName($nome);	
			showProfile($result);
		?>
		
		<script >
			document.getElementById('profilo_link').setAttribute("class", "selected_link");
		</script>			
		
	</body>
</html>