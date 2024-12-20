<?php
	require_once __DIR__ . "/config.php";
	require_once DIR_UTIL . "placeManagerDb.php";
    include DIR_UTIL . "sessionUtil.php";
	session_start();
    if (isAdmin()){
		header('Location: ./luoghiAdmin.php');
		exit;
    }
	if (isLogged()){
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
		<meta name="viewport" content="width=device-width">
		<title>EsploraLaMaremma - Registrazione</title>
	</head>
	<body>  

		<?php
		// define variables and set to empty values
		$emailErr = $userErr =  "";
		$name = $surname = $email = $user = $password  = $number = $comune = "";
		$userValid = $emailValid = 0;
		$success = 2;
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			

			$name = $_POST["name"];		
			
			$surname = $_POST["surname"];
			
			$email = $_POST["email"];
			
			$result1 = email_is_used($email);
			
			if(checkEmptyResult($result1)){
				$emailValid = 1;
			} else{
				$emailErr = "*Email gi&agrave in uso";
				$emailValid = 0;
			}
			
			$user = $_POST["user"];
			
			$result2 = username_is_used($user);

			if(checkEmptyResult($result2)){
				$userValid = 1;
			} else{
				$userErr = "*Nome utente gi&agrave in uso";
				$userValid = 0;
			}
			
		
			$comune = $_POST["comune"];

			
			$password = $_POST["password"];
			$number = $_POST["number"];
			
			if($emailValid && $userValid){
				insert_account($name, $surname, $email, $user, $password, $number, $comune);
				$success = 1;
			}
			else
				$emailValid = $userValid = $success = 0;
				
		}
		
		
		function checkEmptyResult($result){
			if ($result === null || !$result)
				return true;
			
			return ($result->num_rows <= 0);
		}		
	?>
	
	<h2>Registrazione</h2>
	<div class = "form_container">
	<p><span >* campo obbligatorio</span></p>
	<form method="post" name="mio_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit = "return check_password()">  
		<div class = "row">
			<div class = "col_left">
				<label>
					Nome: *
				</label>
			</div>
			<div class = "col_right">
				<input name="name" size="15" type="text" value="<?php echo $name;?>" 
				pattern="[a-zA-Z\u00E0\u00E8\u00EC\u00F2\u00F9\s]+" required><br>
			</div>		
		</div>
		<div class = "row">
			<div class = "col_left">
				<label>
					Cognome: *
				</label>
			</div>
			<div class = "col_right">
				<input name="surname" size="15" type="text" value="<?php echo $surname;?>" 
				pattern="[a-zA-Z\u00E0\u00E8\u00EC\u00F2\u00F9\s]+" required><br>
			</div>		
		</div>
		<div class = "row">
			<div class = "col_left">
				<label>
					E-mail: *
				</label>
			</div>
			<div class = "col_right">
				<input name="email" size="30" type="email" value="<?php echo $email;?>" required>
				<span class="error"><?php echo $emailErr;?></span><br>
			</div>		
		</div>
		<div class = "row">
			<div class = "col_left">
				<label>
					Nome Utente: *
				</label>
			</div>
			<div class = "col_right">
				<input name="user" size="15" type="text" value="<?php echo $user;?>" 
				pattern="[a-zA-Z0-9\s]+" required>
				<span class="error"><?php echo $userErr;?></span><br>
			</div>		
		</div>
		<div class = "row">
			<div class = "col_left">
				<label>
					Password: *<br>
				</label>
			</div>
			<div class = "col_right">
				<input name="password" size="30" type="password" required><br>
			</div>		
		</div>
		<div class = "row">
			<div class = "col_left">
				<label>
					Conferma Password: *<br>
				</label>
			</div>
			<div class = "col_right">
				<input name="repassword" size="30" type="password" onfocus = "normal()" required><br>
			</div>		
		</div>
		
		<div class = "row">
			<div class = "col_left">
				<label>
					Tel:
				</label>
			</div>
			<div class = "col_right">
				<input name="number" size="15" type="tel" value="<?php echo $number;?>" 
				pattern="[0-9]{9,10}" ><br>
			</div>		
		</div>
		<div class = "row">
			<div class = "col_left">
				<label>
					Comune: 
				</label>
			</div>
			<div class = "col_right">
				<input name="comune" size="30" type="text" value="<?php echo $comune;?>" 
				pattern="[a-zA-Z\s]+"><br>
			</div>		
		</div>
		<div class = "row">
			<div class = "col_left">
				<input style="width:20px;height:20px;margin:0px;"type="checkbox" name="privacy_check" required>
				<span>Dichiaro di aver letto, compreso e accettato i <a id = "termini" href="./../html/terms.html" target="_blank">termini di servizio</a></span><br>
			</div>
		</div>
		<div class = "row">
				<input name="bottone_sottometti" value="INVIA" type="submit">
		</div>
	</form>
	<a href = "../index.php"> Torna alla pagina di login</a>
	<?php
		if($success==2){
		echo "<p id='result'>Compila i campi</p>";
		}
		else if($success==0){
			echo "<p id='result' style='color:white; background-color:rgb(235,29,27); border-style:solid; border-width:1px; border-color:red; border-radius:5px; padding: 5px 2px 5px 2px;'>Qualcosa e' andato storto</p>";
		}
		else if($success==1){
			echo "<p id='result' style='color:white; background-color:rgb(51, 198, 24); border-style:solid; border-width:1px; border-color:green; border-radius:5px; padding: 5px 2px 5px 2px;'>Registrazione andata a buon fine</p>";
		}
	?>
	</div>
	
	<script>
	function check_password(){
		var password = document.mio_form.password;
		var repassword = document.mio_form.repassword;
		if (password.value != repassword.value){
			repassword.setAttribute("class", "form_error");
			return false;
		}
		else
			normal();
		return true;
	 }
	 
	 function normal(){
		var repassword = document.mio_form.repassword;
		repassword.setAttribute("class", "form_normal");
	 }
	 
	</script>
	
	
	</body>
</html>