<?php
	
	//setSession: set $_SESSION properly
	function setSession($nome_utente){
		$_SESSION['nome_utente'] = $nome_utente;
		$_SESSION['amministratore'] = 0;

	}
	
	function setAdmin($nome_utente){
		$_SESSION['amministratore'] = 1;
	}

	//isLogged: check if user has logged in and, if it is the case, returns the username
	function isLogged(){		
		if(isset($_SESSION['nome_utente']))
			return $_SESSION['nome_utente'];
		else
			return false;
	}
	function isLogged2(){		
		if(isset($_SESSION['nome_utente']))
			return 1;
		else
			return 0;
	}
	
	function isAdmin(){		
		if(isset($_SESSION['amministratore'])){
			if($_SESSION['amministratore']==1)
				return 1;
			else
				return 0;
		}else
			return 0;
	}

	function displayNome(){
		if(!isLogged())
			echo '<div class = "utente"> <div class = "utente_img"></div><span class= "label_nome">Ospite</span></div> <div class = "logout"><a href="../index.php">login</a></div>';
		else
			echo '<div class = "utente"> <div class = "utente_img"></div><span class= "label_nome">' . $_SESSION['nome_utente'] . '</span></div> <div class = "logout"> <div class = "logout_img"></div> <a href="logout.php">logout</a></div>';
	}
?>