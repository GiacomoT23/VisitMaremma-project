<?php
	require_once __DIR__ . "/config.php";
	require_once DIR_UTIL . "placeManagerDb.php";
    include DIR_UTIL . "sessionUtil.php";
	session_start();
	
	if (!isAdmin()){
		header('Location: ./../index.php');
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
		<script  src="./../js/aggiungiLuogo.js"></script>	
		<meta name="viewport" content="width=device-width">
		<title>EsploraLaMaremma - Registrazione</title>
	</head>
	<body>
	
		<?php
		// define variables and set to empty values
		$nomeLuogoErr = $tipoLuogoErr = $imageErr =/* $userErr = $passwordErr = $genderErr = $numberErr = $comuneErr =*/ "";
		$nomeLuogo = $comune = $descrizione = $localizzazione = $poster = "";
		$mare = $montagna = $storia = $parco = 0;
		$nomeLuogoValid = $tipoLuogoValid = 0;
		$target_dir = "../img/luoghi/";
		$uploadOk = 1;
		$success = 2;

		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
			$nomeLuogo = str_replace(" ", "_", $_POST["nomeLuogo"]);
			$result1 = checkNomeLuogo($nomeLuogo);
			if(checkEmptyResult($result1)){
				$nomeLuogoValid = 1;
			} else{
				$emailErr = "Luogo già presente";
				$nomeLuogoValid = 0;
			}
			
			$comune = $_POST["comune"];
			
			$descrizione = test_input($_POST["descrizione"]);
			
			$localizzazione = $_POST["localizzazione"];
			
			$mare = $_POST["mare"];
			
			$montagna = $_POST["montagna"];
			
			$storia = $_POST["storia"];
			
			$parco = $_POST["parco"];
		
			if(($mare + $montagna + $storia + $parco)==0){
				$tipoLuogoValid  = 0;
				$tipoLuogoErr = "Il luogo deve appartenere almeno a una tipologia";
			}else{
				$tipoLuogoValid  = 1;
				$tipoLuogoErr = "";
			}
			
			/*GESTIONE UPLOAD*/
			
			$poster = $target_dir . basename($_FILES["poster"]["name"]);
			$imageFileType = strtolower(pathinfo($poster,PATHINFO_EXTENSION));
			
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["poster"]["tmp_name"]);
				if($check !== false) {
					$imageErr = "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					$imageErr = "File is not an image.";
					$uploadOk = 0;
				}
			}
			
			if (file_exists($poster)) {
				$imageErr = "Sorry, file already exists.";
				$uploadOk = 0;
			}
			
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				$imageErr = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
			
			/*CONTROLLO E EVENTUALE INSERIMENTO*/
			
			if($nomeLuogoValid == 1 && $tipoLuogoValid == 1 && $uploadOk == 1){
				if(move_uploaded_file($_FILES["poster"]["tmp_name"], $poster)){
					$res = insertLuogo($nomeLuogo, $comune, $descrizione, $mare, $montagna, $storia, $parco, $poster, $localizzazione);
					$success = 1;
				}
				else{
					$success = 0;
					$imageErr = "Sorry, there was an error uploading your file.";
					$nomeLuogoValid = $tipoLuogoValid = 0;
					$uploadOk = 1;
				}
			}else{
				$success = 0;
				$nomeLuogoValid = $tipoLuogoValid = 0;
				$uploadOk = 1;
			}
			
		
		
		}
		
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		
		function checkEmptyResult($result){
			if ($result === null || !$result)
				return true;
			
			return ($result->num_rows <= 0);
		}
		
		?>
		
		
		
		<h2>Aggiungi luogo</h2>
		<div class = "form_container">
		<p><span >* campo obbligatorio</span></p>
		<form method="post" name="aggiungi_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
			<div class = "row">
				<div class = "col_left">
					<label>
						Nome Luogo: *
					</label>
				</div>
				<div class = "col_right">
					<input name="nomeLuogo" size="30" type="text" value="<?php echo str_replace("_", " ",$nomeLuogo);?>" 
					pattern="[a-zA-Z\u00E0\u00E8\u00EC\u00F2\u00F9\s]+" required><?php echo $nomeLuogoErr;?></span>
				</div>		
			</div>
			<div class = "row">
				<div class = "col_left">
					<label>
						Comune: *
					</label>
				</div>
				<div class = "col_right">
					<input name="comune" size="30" type="text" value="<?php echo $comune;?>" 
					pattern="[a-zA-Z\s]+" required>
				</div>		
			</div>
			<div class = "row">
				<div class = "col_left">
					<label>
						Descrizione
					</label>
				</div>
				<div class = "col_right">
					<textarea name="descrizione" rows="7" cols="30"
					 id="descrizione" onkeyup="ContaCaratteri()"><?php echo $descrizione;?></textarea>
					<input type="text" id="counter" size="2" value="6000" readonly="readonly">
					<span id="aggiungi_luogo_message"></span>
				</div>		
			</div>
			<div class = "row">
				<div class = "col_left">
					<label>
						Mare: *
					</label>
				</div>
				<div class = "col_right">
					<input type="radio" name="mare" <?php if (isset($mare) && $mare==0) echo "checked";?> value="0" >No
					<input type="radio" name="mare" <?php if (isset($mare) && $mare==1) echo "checked";?> value="1">Si
					<span><?php echo $nomeLuogoErr;?></span>
				</div>		
			</div>
			<div class = "row">
				<div class = "col_left">
					<label>
						Montagna/Collina: *
					</label>
				</div>
				<div class = "col_right">
					<input type="radio" name="montagna" <?php if (isset($montagna) && $montagna==0) echo "checked";?> value="0" >No
					<input type="radio" name="montagna" <?php if (isset($montagna) && $montagna==1) echo "checked";?> value="1">Si
				</div>		
			</div>
			<div class = "row">
				<div class = "col_left">
					<label>
						Storia/Archeologia: *
					</label>
				</div>
				<div class = "col_right">
						<input type="radio" name="storia" <?php if (isset($storia) && $storia==0) echo "checked";?> value="0" >No
						<input type="radio" name="storia" <?php if (isset($storia) && $storia==1) echo "checked";?> value="1">Si
				</div>		
			</div>
			<div class = "row">
				<div class = "col_left">	
					<label>
						Parco/Riserva: *
					</label>
				</div>
				<div class = "col_right">
					<input type="radio" name="parco" <?php if (isset($parco) && $parco==0) echo "checked";?> value="0" >No
					<input type="radio" name="parco" <?php if (isset($parco) && $parco==1) echo "checked";?> value="1">Si
				</div>		
			</div>
			<div class = "row">
				<div class = "col_left">
					<label>
						Immagine(inserire immagini dimensione 3:2 per risultato ottimale, no lettere accentate): * 
					</label>
				</div>
				<div class = "col_right">
					<input type="file" name="poster" id="poster" required>
					<?php echo $imageErr;?></span>
				</div>		
			</div>
			<div class = "row">
				<div class = "col_left">
					<label>
						Localizzazione: *
					</label>
				</div>
				<div class = "col_right">
					<input type="url" id="localizzazione" name="localizzazione" size="500" value = "<?php echo $localizzazione;?>" required>
				</div>		
			</div>
			<div class = "row">
				<input name="bottone_sottometti" value="INVIA" type="submit">
			</div>
		</form>
		<a href="luoghiAdmin.php">Torna ai luoghi</a>
			
		<?php
		if($success==2){
		echo "<p id='result'>Compila i campi</p>";
		}
		else if($success==0){
			echo "<p id='result' style='color:white; background-color:rgb(235,29,27); border-style:solid; border-width:1px; border-color:red; border-radius:5px; padding: 5px 2px 5px 2px;'>Qualcosa e' andato storto</p>";
		}
		else if($success==1){
			echo "<p id='result' style='color:white; background-color:rgb(51, 198, 24); border-style:solid; border-width:1px; border-color:green; border-radius:5px; padding: 5px 2px 5px 2px;'>Luogo aggiunto</p>";
		}
		?>
	</body>
</html>