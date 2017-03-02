<?php


	function identifiant_exists() : bool {
		$membre = bdd_select( 'SELECT login FROM employe WHERE  login = ?', [$_POST['login']] );
		
		if( !empty ( $membre ) ) {
			//si ok, je retourne toutes les infos
			return true;
		}else {
			//sinon je retourne un tableau vide (donc aucune info sous la forme d'un tableau)
			return false;
		}
	};
	
	//vérifie si mail existe
	function mail_exists() : bool {
		$membre = bdd_select( 'SELECT mail FROM employe WHERE  mail = ?', [$_POST['login']] );
		
		if( !empty ( $membre ) ) {
			//si ok, je retourne toutes les infos
			return true;
		}else {
			//sinon je retourne un tableau vide (donc aucune info sous la forme d'un tableau)
			return false;
		}
	};
	
	//Gère l'envoi de mails à partir du 'login'
	function mail_html(string $subject, string $message) {
		//Contient l'email 
		$ident = bdd_select("SELECT mail FROM employe WHERE login = ?", [ $_POST['login'] ]);
		$ConvertToString = $ident[0]['mail'];
		$to = $ConvertToString;
		$headers = "From fabienreve@yahoo.fr \r\n";
		
		mail($to, $subject, $message, $headers);
	};
	//Récupère nom et prénom par rapport au login
	function getNomPrenomEmploye() : string {
		$membre = bdd_select( 'SELECT prenomEmploye, nomEmploye FROM employe WHERE login = ?', [$_POST['login']] );
		if( !empty ($membre) ) {
			$infos = $membre[0]['prenomEmploye'].' '.$membre[0]['nomEmploye'];

			return $infos;
		}
	}
	//Récupère nom et prénom par rapport au mail 
	function getNomPrenomEmploye2() : string {
		$membre = bdd_select( 'SELECT prenomEmploye, nomEmploye FROM employe WHERE mail = ?', [$_POST['login']] );
		if( !empty ($membre) ) {
			$infos = $membre[0]['prenomEmploye'].' '.$membre[0]['nomEmploye'];

			return $infos;
		}
	}
	
	//récupère le mot de passe
	function password_recupe() : string {
		$membre = bdd_select( 'SELECT mdp FROM employe WHERE  login = ?', [$_POST['login']] );
		if( !empty ($membre) ) {
			$mdp = $membre[0]['mdp'];

			return $mdp;
		}		
	};
	
	//récupère le mot de passe à partir du mail
	function password_recupeMail() : string {
		$membre = bdd_select( 'SELECT mdp FROM employe WHERE mail = ?', [$_POST['login']] );
		if( !empty ($membre) ) {
			$mdp = $membre[0]['mdp'];

			return $mdp;
		}		
	};
	
	//Gère l'envoi de mails à partir du 'mail'
	function mail_html2(string $subject, string $message) {
		//Contient l'email 
		$ident = bdd_select("SELECT mail FROM employe WHERE mail = ?", [ $_POST['login'] ]);
		$ConvertToString = $ident[0]['mail'];
		$to = $ConvertToString;
		$headers = "From fabienreve@yahoo.fr \r\n";
		
		mail($to, $subject, $message, $headers);
	};

?>