<?php
	function identifiant_exists() : bool {
		$membre = bdd_select( 'SELECT nom FROM employe WHERE  nom = ?', [$_POST['nom']] );
		
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
		$ident = bdd_select("SELECT mail FROM employe WHERE nom = ?", [ $_POST['nom'] ]);
		$ConvertToString = $ident[0]['mail'];
		$to = $ConvertToString;
		$headers = "From fabienreve@yahoo.fr \r\n";
		
		mail($to, $subject, $message, $headers);
	};
	
	function password_recupe() : string {
		$membre = bdd_select( 'SELECT mdp FROM employe WHERE  nom = ?', [$_POST['nom']] );
		if( !empty ($membre) ) {
			$mdp = $membre[0]['mdp'];

			return $mdp;
		}		
	};

?>