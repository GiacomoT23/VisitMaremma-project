<?php
	session_start();
	require_once __DIR__ . "/php/config.php";
    include DIR_UTIL . "sessionUtil.php";

    if (isLogged()){
		if($_SESSION['amministratore'] == 1)
		    header('Location: ./php/luoghiAdmin.php');
		else
		    header('Location: ./php/home.php');
		    exit;
    }	
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
    	<meta name = "author" content = "PWEB">
		<link rel="stylesheet" href="css/index.css" type="text/css" media="screen">
   	 	<link rel="shortcut icon" type="image/x-icon" href="./css/img/favicon.ico" />
		<meta name="viewport" content="width=device-width">
		<title>Esplora la Maremma</title>
	</head>
	<body>
		<div class = "header">
			<h1 id = "index_header"> Vivi la Maremma </h1>
			<p id = "little_index_header">Scopri, visita, valuta</p>
		</div>
		<div id = "content">
			<div id="index_div_form">
				<form name="login" action="./php/login.php" method="post">
					<div class = "campo">
						<input type="text" placeholder="Utente" name="nome_utente" required autofocus>
					</div>
					<div class = "campo">
						<input type="password" placeholder="Password" name="password" required>
					</div>	
					<div class = "campo">
					<input type="submit" value="Enter">
						<?php
							if (isset($_GET['errorMessage'])){
								echo '<div class="sign_in_error">';
								echo '<span class = "error">' . $_GET['errorMessage'] . '</span>';
								echo '</div>';
							}
						?>
					</div>
				</form>
				<br>
				<a href = "php/registrazione.php" > Registrati </a><br>
				<a href = "php/home.php" > Entra come ospite </a>
			</div>
		</div>
		<footer id="index_footer">
			<div class="legal_form">
				<a href="./html/terms.html" >Termini di servizio</a>
			</div>
		</footer>
	</body>
</html>
			