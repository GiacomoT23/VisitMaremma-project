<?php
	require_once __DIR__ . "/config.php";
	session_start();
    include DIR_UTIL . "sessionUtil.php";
	if (isAdmin()){
		header('Location: ./luoghiAdmin.php');
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
		<script  src="./../js/ajax/UserPlaceEventHandler.js"></script>	
		<script  src="./../js/ajax/PlaceLoader.js"></script>
		<script  src="./../js/ajax/PlaceDashboard.js"></script>
		<meta name="viewport" content="width=device-width">
		<title>EsploraLaMaremma - Luoghi</title>
	</head>
	
	<?php
		$searchType = 0;
		$admin = isAdmin();
		$logged = isLogged2();
		if(isset($_GET['search_type']))
			$searchType = $_GET['search_type'];
		echo '<body onload="PlaceLoader.init(' . $searchType . ');  ';
		echo 'PlaceLoader.loadData(' . $searchType . ', ' . $admin . ', ' . $logged . ')" style="	background-color: rgb(255,255,140);">'; 
		
		include DIR_LAYOUT . "menu.php";
		

		
		?>	
	
	
	<ul class = "knownPlaces">
		<li><a href = "visitati.php" class = "unselected_link">Visitati</a></li>
		<li><a href = "daVisitare.php" class = "unselected_link">Da visitare</a></li>
	</ul>
	
	<?php	


		if(!isset($_GET['search_type']))
			echo '<h1 class="luoghi_header">Tutti i luoghi</h1>';
			
		if(isset($_GET['search_type'])){
			if($searchType==0)
				echo '<h1 class="luoghi_header">Tutti i luoghi</h1>';
			else if($searchType==3)
				echo '<h1 class="luoghi_header">Luoghi di mare</h1>';
			else if($searchType==4)
				echo '<h1 class="luoghi_header">Luoghi di montagna e di collina</h1>';
			else if($searchType==5)
				echo '<h1 class="luoghi_header">Luoghi di interesse storico</h1>';
			else if($searchType==6)
				echo '<h1 class="luoghi_header">Relax, parchi e riserve naturali</h1>';
		}
		
		include DIR_LAYOUT . "navigation_page.php";

		echo '<div id="placeDashboard" class="place_dashboard"></div>'; // Fill dinamically with Ajax Request 
			
		include DIR_LAYOUT . "navigation_page.php";
		include DIR_LAYOUT . "footer.php";
			
	?>
	</body>
</html>