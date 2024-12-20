<?php
	require_once __DIR__ . "/../config.php";
    require_once DIR_UTIL . "esploraLaMaremmaDbManager.php"; //includes Database Class
 	
	
	function getPlaceByName($nome){
		global $esploraLaMaremmaDb;
		$nome = $esploraLaMaremmaDb->sqlInjectionFilter($nome);
		$queryText = 'SELECT * '
						. 'FROM luogo '
						. 'WHERE nome_luogo = \'' . $nome . '\'';

		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}	
	
	function getAccountByName($nome){
		global $esploraLaMaremmaDb;
		$nome = $esploraLaMaremmaDb->sqlInjectionFilter($nome);
		$queryText = 'SELECT * '
						. 'FROM account '
						. 'WHERE nome_utente = \'' . $nome . '\'';

		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function getSearchPlacesByName($pattern, $numRecord, $offset){
		global $esploraLaMaremmaDb;
		$pattern = $esploraLaMaremmaDb->sqlInjectionFilter($pattern);
		$queryText = 'SELECT * ' 
					. 'FROM luogo '
					. 'WHERE nome_luogo LIKE \'%' . $pattern . '%\' LIMIT ' . $offset . ', ' . $numRecord ;
 	
 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function getUserPlaceStat($nomeUtente, $nome){
		global $esploraLaMaremmaDb;
		$nomeUtente = $esploraLaMaremmaDb->sqlInjectionFilter($nomeUtente);
		$nome = $esploraLaMaremmaDb->sqlInjectionFilter($nome);
 		$queryText = 'SELECT * '
					. 'FROM account_luogo '
					. 'WHERE nome_utente = \'' . $nomeUtente . '\' AND nome_luogo = \'' . $nome . '\' ';
 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}	
	
	function getAllPlaces($offset, $numRecord){
		global $esploraLaMaremmaDb;
 		$offset = $esploraLaMaremmaDb->sqlInjectionFilter($offset);
		$numRecord = $esploraLaMaremmaDb->sqlInjectionFilter($numRecord);
		$queryText = 'SELECT * FROM luogo LIMIT ' . $offset . ', ' . $numRecord ;

 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
		function getToVisitPlaces($nomeUtente, $offset, $numRecord){
		global $esploraLaMaremmaDb;
		$nomeUtente = $esploraLaMaremmaDb->sqlInjectionFilter($nomeUtente);
 		$offset = $esploraLaMaremmaDb->sqlInjectionFilter($offset);
		$numRecord = $esploraLaMaremmaDb->sqlInjectionFilter($numRecord);
		$queryText = 'SELECT * '
					. 'FROM account_luogo al JOIN luogo l ON al.nome_luogo = l.nome_luogo '
					. 'WHERE al.nome_utente = \'' . $nomeUtente . '\' AND al.da_visitare = 1 '
					. 'LIMIT ' . $offset . ',' . $numRecord ;

 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function getVisitedPlaces($nomeUtente, $offset, $numRecord){
		global $esploraLaMaremmaDb;
		$nomeUtente = $esploraLaMaremmaDb->sqlInjectionFilter($nomeUtente);
 		$offset = $esploraLaMaremmaDb->sqlInjectionFilter($offset);
		$numRecord = $esploraLaMaremmaDb->sqlInjectionFilter($numRecord);
		$queryText = 'SELECT * '
					. 'FROM account_luogo al JOIN luogo l ON al.nome_luogo = l.nome_luogo '
					. 'WHERE al.nome_utente = \'' . $nomeUtente . '\' AND al.visitato = 1 '
					. 'LIMIT ' . $offset . ',' . $numRecord ;
 		
 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function getMarePlaces($offset, $numRecord){
		global $esploraLaMaremmaDb;
 		$offset = $esploraLaMaremmaDb->sqlInjectionFilter($offset);
		$numRecord = $esploraLaMaremmaDb->sqlInjectionFilter($numRecord);
		$queryText = 'SELECT * FROM luogo WHERE mare=1 LIMIT ' . $offset . ', ' . $numRecord ;

 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function getMontagnaPlaces($offset, $numRecord){
		global $esploraLaMaremmaDb;
 		$offset = $esploraLaMaremmaDb->sqlInjectionFilter($offset);
		$numRecord = $esploraLaMaremmaDb->sqlInjectionFilter($numRecord);
		$queryText = 'SELECT * FROM luogo WHERE montagnaCollina=1 LIMIT ' . $offset . ', ' . $numRecord ;

 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function getStoriaPlaces($offset, $numRecord){
		global $esploraLaMaremmaDb;
 		$offset = $esploraLaMaremmaDb->sqlInjectionFilter($offset);
		$numRecord = $esploraLaMaremmaDb->sqlInjectionFilter($numRecord);
		$queryText = 'SELECT * FROM luogo WHERE storiaArcheologia=1 LIMIT ' . $offset . ', ' . $numRecord ;

 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function getParcoPlaces($offset, $numRecord){
		global $esploraLaMaremmaDb;
 		$offset = $esploraLaMaremmaDb->sqlInjectionFilter($offset);
		$numRecord = $esploraLaMaremmaDb->sqlInjectionFilter($numRecord);
		$queryText = 'SELECT * FROM luogo WHERE parcoRiserva=1 LIMIT ' . $offset . ', ' . $numRecord ;

 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function removePlace($nomeLuogo){
		global $esploraLaMaremmaDb;
		$nomeLuogo = $esploraLaMaremmaDb->sqlInjectionFilter($nomeLuogo);

		$queryText = 'DELETE FROM luogo WHERE nome_luogo = \'' . $nomeLuogo . '\'';

 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
function remove_reviews_luogo($nomeLuogo){
		global $esploraLaMaremmaDb;
		$nomeLuogo = $esploraLaMaremmaDb->sqlInjectionFilter($nomeLuogo);

		$queryText = 'DELETE FROM recensioni WHERE nome_luogo = \'' . $nomeLuogo . '\'';

 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
function remove_liste_luogo($nomeLuogo){
		global $esploraLaMaremmaDb;
		$nomeLuogo = $esploraLaMaremmaDb->sqlInjectionFilter($nomeLuogo);

		$queryText = 'DELETE FROM account_luogo WHERE nome_luogo = \'' . $nomeLuogo . '\'';

 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function insertVisitedUserPlaceStat($nome, $nomeUtente, $isVisitedFlag){
		global $esploraLaMaremmaDb;
		$nomeUtente = $esploraLaMaremmaDb->sqlInjectionFilter($nomeUtente);
		$nome = $esploraLaMaremmaDb->sqlInjectionFilter($nome);
 		$isVisitedFlag = $esploraLaMaremmaDb->sqlInjectionFilter($isVisitedFlag);
		$queryText = 'INSERT INTO account_luogo (nome_utente, nome_luogo, visitato, da_visitare) ' 
						. 'VALUES (\'' . $nomeUtente . '\', \'' . $nome . '\', ' . $isVisitedFlag . ', 0)';
 	
 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function updateVisitedUserPlaceStat($nome, $nomeUtente, $isVisitedFlag){
		global $esploraLaMaremmaDb;
		$nomeUtente = $esploraLaMaremmaDb->sqlInjectionFilter($nomeUtente);
		$nome = $esploraLaMaremmaDb->sqlInjectionFilter($nome);
 		$isVisitedFlag = $esploraLaMaremmaDb->sqlInjectionFilter($isVisitedFlag);
 		$queryText = 'UPDATE account_luogo '
					. 'SET visitato=' . $isVisitedFlag . ', da_visitare=0 '
					. 'WHERE nome_utente=\'' . $nomeUtente . '\' AND nome_luogo = \'' . $nome . '\'';
 		
 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function insertToVisitUserPlaceStat($nome, $nomeUtente, $toVisitFlag){
		global $esploraLaMaremmaDb;
		$nomeUtente = $esploraLaMaremmaDb->sqlInjectionFilter($nomeUtente);
		$nome = $esploraLaMaremmaDb->sqlInjectionFilter($nome);
		$toVisitFlag = $esploraLaMaremmaDb->sqlInjectionFilter($toVisitFlag);
		$queryText = 'INSERT INTO account_luogo (nome_utente, nome_luogo, visitato, da_visitare) ' 
						. 'VALUES (\'' . $nomeUtente . '\', \'' . $nome . '\', 0, ' . $toVisitFlag . ')';
 	
 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function updateToVisitUserPlaceStat($nome, $nomeUtente, $toVisitFlag, $response){
		global $esploraLaMaremmaDb;
		$nomeUtente = $esploraLaMaremmaDb->sqlInjectionFilter($nomeUtente);
		$nome = $esploraLaMaremmaDb->sqlInjectionFilter($nome);
		$toVisitFlag = $esploraLaMaremmaDb->sqlInjectionFilter($toVisitFlag);
		$queryText = 'UPDATE account_luogo '
					. 'SET da_visitare=' . $toVisitFlag . ', visitato=0 '
					. 'WHERE nome_utente=\'' . $nomeUtente . '\' AND nome_luogo = \'' . $nome . '\'';
 	
 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	
	
	
	function countVisited($nome){
		global $esploraLaMaremmaDb;
		$nome = $esploraLaMaremmaDb->sqlInjectionFilter($nome);
		$queryText = 'SELECT COUNT(*) '
						. 'FROM account_luogo '
						. 'WHERE nome_utente = \'' . $nome . '\' AND visitato = 1';

		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function countToVisit($nome){
		global $esploraLaMaremmaDb;
		$nome = $esploraLaMaremmaDb->sqlInjectionFilter($nome);
		$queryText = 'SELECT COUNT(*) '
						. 'FROM account_luogo '
						. 'WHERE nome_utente = \'' . $nome . '\' AND da_visitare = 1';

		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}	
	
	function get_number($nome){
		global $esploraLaMaremmaDb;
		$nome = $esploraLaMaremmaDb->sqlInjectionFilter($nome);
		$queryText = 'SELECT telefono '
						. 'FROM account '
						. 'WHERE nome_utente = \'' . $nome . '\'';

		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function get_comune($nome){
		global $esploraLaMaremmaDb;
		$nome = $esploraLaMaremmaDb->sqlInjectionFilter($nome);
		$queryText = 'SELECT comune '
						. 'FROM account '
						. 'WHERE nome_utente = \'' . $nome . '\'';

		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function update_account($nome, $number, $comune){
		global $esploraLaMaremmaDb;
		$number = $esploraLaMaremmaDb->sqlInjectionFilter($number);
		$nome = $esploraLaMaremmaDb->sqlInjectionFilter($nome);
 		$comune = $esploraLaMaremmaDb->sqlInjectionFilter($comune);
 		$queryText = 'UPDATE account '
					. 'SET telefono=\'' . $number . '\', comune=\'' . $comune . '\''
					. 'WHERE nome_utente=\'' . $nome . '\'';
 		
 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	
	/*REGISTRAZIONE-----------------------------------------------*/
	
	function email_is_used($email){
		global $esploraLaMaremmaDb;
		$email = $esploraLaMaremmaDb->sqlInjectionFilter($email);
		$queryText = 'SELECT * FROM account WHERE email = \'' . $email . '\'' ;
		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function username_is_used($user){
		global $esploraLaMaremmaDb;
		$user = $esploraLaMaremmaDb->sqlInjectionFilter($user);
		$queryText = 'SELECT * FROM account WHERE nome_utente = \'' . $user . '\'' ;
		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function insert_account($name, $surname, $email, $user, $password,/* $gender,*/ $number, $comune){
		global $esploraLaMaremmaDb;
		$name = $esploraLaMaremmaDb->sqlInjectionFilter($name);
		$surname = $esploraLaMaremmaDb->sqlInjectionFilter($surname);
		$email = $esploraLaMaremmaDb->sqlInjectionFilter($email);
		$user = $esploraLaMaremmaDb->sqlInjectionFilter($user);
		$password = $esploraLaMaremmaDb->sqlInjectionFilter($password);
		//$gender = $esploraLaMaremmaDb->sqlInjectionFilter($gender);
		$number = $esploraLaMaremmaDb->sqlInjectionFilter($number);
		$comune = $esploraLaMaremmaDb->sqlInjectionFilter($comune);
		$queryText = "INSERT INTO account VALUES('" . $user . "', '" . $password . "', '" . $email . "', '" . $name . "', '" . $surname . "', '" . $number . /*"', '" . $gender .*/ "', '" . $comune . "', 0)" ;
		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	/*RECENSIONI--------------------------------------------------------------------------------*/
	
	function getAllReviews($nome, $offset, $numRecord){
		global $esploraLaMaremmaDb;
		$nome = $esploraLaMaremmaDb->sqlInjectionFilter($nome);
		$offset = $esploraLaMaremmaDb->sqlInjectionFilter($offset);
		$numRecord = $esploraLaMaremmaDb->sqlInjectionFilter($numRecord);
		$queryText = 'SELECT * FROM recensioni WHERE nome_luogo = \'' . $nome . '\' ORDER BY istante DESC  LIMIT ' . $offset . ', ' . $numRecord ;

 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function getPreviousReview($nomeLuogo, $nomeUtente){
		global $esploraLaMaremmaDb;
		$nomeLuogo = $esploraLaMaremmaDb->sqlInjectionFilter($nomeLuogo);
		$nomeUtente = $esploraLaMaremmaDb->sqlInjectionFilter($nomeUtente);

		$queryText = 'SELECT * FROM recensioni WHERE nome_luogo = \'' . $nomeLuogo . '\' AND nome_utente = \'' . $nomeUtente . '\'';     

 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function removeReview($nomeLuogo, $nomeUtente){
		global $esploraLaMaremmaDb;
		$nomeLuogo = $esploraLaMaremmaDb->sqlInjectionFilter($nomeLuogo);
		$nomeUtente = $esploraLaMaremmaDb->sqlInjectionFilter($nomeUtente);

		$queryText = 'DELETE FROM recensioni WHERE nome_luogo = \'' . $nomeLuogo . '\' AND nome_utente = \'' . $nomeUtente . '\'';

 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function insertReview($nomeLuogo, $nomeUtente, $rating, $review){
		global $esploraLaMaremmaDb;
		$nomeLuogo = $esploraLaMaremmaDb->sqlInjectionFilter($nomeLuogo);
		$nomeUtente = $esploraLaMaremmaDb->sqlInjectionFilter($nomeUtente);
		$rating = $esploraLaMaremmaDb->sqlInjectionFilter($rating);
		$review = $esploraLaMaremmaDb->sqlInjectionFilter($review);

		$queryText = "INSERT INTO recensioni VALUES('" . $nomeLuogo . "', '" . $nomeUtente . "', " . $rating . ", '" . $review . "', CURRENT_TIMESTAMP)" ;
		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	/*AGGIUNGI LUOGO*/
	
	function insertLuogo($nomeLuogo, $comune, $descrizione, $mare, $montagna, $storia, $parco, $localizzazione, $poster){
		global $esploraLaMaremmaDb;
		$nomeLuogo = $esploraLaMaremmaDb->sqlInjectionFilter($nomeLuogo);
		$comune = $esploraLaMaremmaDb->sqlInjectionFilter($comune);
		$descrizione = $esploraLaMaremmaDb->sqlInjectionFilter($descrizione);
		$mare = $esploraLaMaremmaDb->sqlInjectionFilter($mare);
		$montagna = $esploraLaMaremmaDb->sqlInjectionFilter($montagna);
		$storia = $esploraLaMaremmaDb->sqlInjectionFilter($storia);
		$parco = $esploraLaMaremmaDb->sqlInjectionFilter($parco);
		$localizzazione = $esploraLaMaremmaDb->sqlInjectionFilter($localizzazione);
		$poster = $esploraLaMaremmaDb->sqlInjectionFilter($poster);

		$queryText = "INSERT INTO luogo VALUES('" . $nomeLuogo . "', '" . $comune . "', '" . $descrizione . "', '" . $mare . "', '" . $montagna . "', '" . $storia . "', '" . $parco . "', '" . $localizzazione . "', '" . $poster . "')" ;
		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function checkNomeLuogo($nomeLuogo){
		global $esploraLaMaremmaDb;
		$nomeLuogo = $esploraLaMaremmaDb->sqlInjectionFilter($nomeLuogo);
		$queryText = 'SELECT * FROM luogo WHERE nome_luogo = \'' . $nomeLuogo . '\'' ;
		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	/*UTENTI ADMIN*/
	function getAllUsers($offset, $numRecord){
		global $esploraLaMaremmaDb;
 		$offset = $esploraLaMaremmaDb->sqlInjectionFilter($offset);
		$numRecord = $esploraLaMaremmaDb->sqlInjectionFilter($numRecord);
		$queryText = 'SELECT * FROM account WHERE amministratore=0 LIMIT ' . $offset . ', ' . $numRecord ;

 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function removeUser($nomeUtente){
		global $esploraLaMaremmaDb;
		$nomeUtente = $esploraLaMaremmaDb->sqlInjectionFilter($nomeUtente);

		$queryText = 'DELETE FROM account WHERE nome_utente = \'' . $nomeUtente . '\'';

 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function removeUserReviews($nomeUtente){
		global $esploraLaMaremmaDb;
		$nomeUtente = $esploraLaMaremmaDb->sqlInjectionFilter($nomeUtente);

		$queryText = 'DELETE FROM recensioni WHERE nome_utente = \'' . $nomeUtente . '\'';

 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function removeUserLists($nomeUtente){
		global $esploraLaMaremmaDb;
		$nomeUtente = $esploraLaMaremmaDb->sqlInjectionFilter($nomeUtente);

		$queryText = 'DELETE FROM account_luogo WHERE nome_utente = \'' . $nomeUtente . '\'';

 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
	
	function getSearchUsersByName($pattern, $numRecord, $offset){
		global $esploraLaMaremmaDb;
		$pattern = $esploraLaMaremmaDb->sqlInjectionFilter($pattern);
		$queryText = 'SELECT * ' 
					. 'FROM account '
					. 'WHERE nome_utente LIKE \'%' . $pattern . '%\' AND amministratore=0 LIMIT ' . $offset . ', ' . $numRecord; 
 	
 		$result = $esploraLaMaremmaDb->performQuery($queryText);
		$esploraLaMaremmaDb->closeConnection();
		return $result; 
	}
?>

