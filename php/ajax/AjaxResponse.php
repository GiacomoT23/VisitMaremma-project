<?php  

	class AjaxResponse{
		public $responseCode; // 0 all ok - 1 some errors - -1 some warning
		public $message;
		public $data;
		
		function AjaxResponse($responseCode = 1, 
								$message = "Somenthing went wrong! Please try later.",
								$data = null){
			$this->responseCode = $responseCode;
			$this->message = $message;
			$this->data = null;
		}
	
	}
	
	class PlaceUserStat{
		public $place;
		public $placeUserStat;
		function PlaceUserStat($place = null, $placeUserStat = null){
			$this->place = $place;
			$this->placeUserStat = $placeUserStat;
		}
	}
	
	class Place{
		public $nome;
		public $posterUrl;
		public $comune;
		public $mare;
		public $montagna;
		public $storia;
		public $parco;
		function Place($nome = null, $posterUrl = null, $comune = null, $mare = null, $montagna = null, $storia = null, $parco = null){
			$this->nome = $nome;
			$this->posterUrl = $posterUrl;
			$this->comune = $comune;
			$this->mare = $mare;
			$this->montagna = $montagna;
			$this->storia = $storia;
			$this->parco = $parco;
		}
	}
	
	class UserStat{
		public $visitato;
		public $daVisitare;
		function UserStat($visitato = 0, $daVisitare = 0){
			$this->visitato = $visitato;
			$this->daVisitare = $daVisitare;
		}
	}
	
	class Review{
		public $nomeLuogo;
		public $nomeUtente;
		public $valutazione;
		public $recensione;
		public $istante;
		function Review($nomeLuogo = null, $nomeUtente = null, $valutazione = null, $recensione = null, $istante = null) {
			$this->nomeLuogo = $nomeLuogo;
			$this->nomeUtente = $nomeUtente;
			$this->valutazione = $valutazione;
			$this->recensione = $recensione;
			$this->istante = $istante;
		}
	}
	
	class User{
		public $nomeUtente;
		public $email;
		public $nome;
		public $cognome;
		public $telefono;
		public $comune;
		function User($nomeUtente = null, $email = null, $nome = null, $cognome = null, $telefono = null, $sesso = null, $comune = null){
			$this-> nomeUtente = $nomeUtente;
			$this-> email = $email;
			$this-> nome = $nome;
			$this-> cognome = $cognome;
			$this-> telefono = $telefono;
			$this-> comune = $comune;
		}
	}
?>