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
	
	//Gère l'envoi de mails
	function mail_html(string $subject, string $message) {
		//Contient l'email 
		$ident = bdd_select("SELECT mail FROM employe WHERE login = ?", [ $_POST['login'] ]);
		$ConvertToString = $ident[0]['mail'];
		$to = $ConvertToString;
		$headers = "From fabienreve@yahoo.fr \r\n";
		
		mail($to, $subject, $message, $headers);
	};
	
	function password_recupe() : string {
		$membre = bdd_select( 'SELECT mdp FROM employe WHERE  login = ?', [$_POST['login']] );
		if( !empty ($membre) ) {
			$mdp = $membre[0]['mdp'];

			return $mdp;
		}		
	};
	
	function password_recupeMail() : string {
		$membre = bdd_select( 'SELECT mdp FROM employe WHERE mail = ?', [$_POST['login']] );
		if( !empty ($membre) ) {
			$mdp = $membre[0]['mdp'];

			return $mdp;
		}		
	};
	
	function mail_html2(string $subject, string $message) {
		//Contient l'email 
		$ident = bdd_select("SELECT mail FROM employe WHERE mail = ?", [ $_POST['login'] ]);
		$ConvertToString = $ident[0]['mail'];
		$to = $ConvertToString;
		$headers = "From fabienreve@yahoo.fr \r\n";
		
		mail($to, $subject, $message, $headers);
	};

?>