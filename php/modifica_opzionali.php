<?php
	require_once __DIR__ . "/config.php";
	require_once DIR_UTIL . "placeManagerDb.php";
    include DIR_UTIL . "sessionUtil.php";
	session_start();
	
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
		<link rel="stylesheet" href="./../css/registrazione.css" type="text/css" media="screen">
   	 	<link rel="shortcut icon" type="image/x-icon" href="./../css/img/favicon.ico" />
		<meta name="viewport" content="width=device-width">
		<title>EsploraLaMaremma - Modifica</title>
	</head>
	<body>  

		<?php
		
		
		$user = $_SESSION["nome_utente"];
		
		$result1 = get_number($user);
		$row1 = $result1->fetch_assoc();
		$number = $row1['telefono'];

		$result2 = get_comune($user);
		$row2 = $result2->fetch_assoc();
		$comune = $row2['comune'];
		
		
		$number2 = $comune2 = "";
		$success = 2;
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			

			
		
			$comune2 = $_POST["comune"];

			
			$number2 = $_POST["number"];
			
				update_account($user, $number2, $comune2);
				$success = 1;
			
				
		}
		
		
	?>
	
	<h2>Modifica profilo</h2>
	<div class = "form_container">
	<form method="post" name="mio_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >  
		
		<div class = "row">
			<div class = "col_left">
				<label>
					Tel corrente:
				</label>
			</div>
			<div class = "col_right">
				<input name="number" size="15" type="tel" value="<?php echo $number;?>" 
				 readonly = "readonly">
			</div>		
		</div>
		<div class = "row">
			<div class = "col_left">
				<label>
					Nuovo tel:
				</label>
			</div>
			<div class = "col_right">
				<input name="number" size="15" type="tel" value="<?php echo $number2;?>" 
				pattern="[0-9]{9,10}" >
			</div>		
		</div>
		<div class = "row">
			<div class = "col_left">
				<label>
					Comune corrente: 
				</label>
			</div>
			<div class = "col_right">
				<input name="comune" size="30" type="text" value="<?php echo $comune;?>" 
				pattern="[a-zA-Z\s]+" readonly = "readonly">
			</div>		
		</div>
		<div class = "row">
			<div class = "col_left">
				<label>
					Nuovo comune: 
				</label>
			</div>
			<div class = "col_right">
				<input name="comune" size="30" type="text" value="<?php echo $comune2;?>" 
				pattern="[a-zA-Z\s]+">
			</div>		
		</div>
		<div class = "row">
			<input name="bottone_sottometti" value="INVIA" type="submit">
		</div>
	</form>
	<a href = "./profilo.php"> Torna al profilo</a>
	<?php
		if($success==2){
		echo "<p id='result'>Compila i campi</p>";
		}
		else if($success==0){
			echo "<p id='result' style='color:white; background-color:rgb(235,29,27); border-style:solid; border-width:1px; border-color:red; border-radius:5px; padding: 5px 2px 5px 2px;'>Qualcosa e' andato storto</p>";
		}
		else if($success==1){
			echo "<p id='result' style='color:white; background-color:rgb(51, 198, 24); border-style:solid; border-width:1px; border-color:green; border-radius:5px; padding: 5px 2px 5px 2px;'>Modifica andata a buon fine</p>";
		}
	?>
	</div>
	

	
	</body>
</html>