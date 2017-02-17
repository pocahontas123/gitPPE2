<?php
	
	function account_exists() : array{
		$membre = bdd_select( 'SELECT idEmploye, mdp FROM employe WHERE nom = ?', [$_POST['nom']] );
		
		//Si j'ai une concordance de mail entre la BDD et le formulaire, je vérifie que le mdp du formulaire est pareil que la BDD
		if( !empty ($membre) && ($_POST['mdp'] == $membre[0]['mdp'])) {
			//si ok, je retourne toutes les infos
			return $membre[0];
		}else {
			//sinon je retourne un tableau vide (donc aucune info sous la forme d'un tableau)
			return [];
		}
	};

	function bdd_select( string $query, array $params = [] ) {
	  require 'incl/pdo.php';

	  if ( $params ) {
		$req = $bdd->prepare( $query );
		$req->execute( $params );
	  }
	  else {
		$req = $bdd->query( $query );
	  }

	  $data = $req->fetchAll();

	  return $data;
	}
	
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
	
	function password_recupe() : string {
		$membre = bdd_select( 'SELECT mdp FROM employe WHERE  nom = ?', [$_POST['nom']] );
		if( !empty ($membre) ) {
			$password = $membre[0]['mdp'];
			var_dump($mdp);
			return $mdp;
		}		
	}
	
	//Gère l'envoi de mails
	function mail_html(string $subject, string $message) {
		//Contient l'email 
		$ident = bdd_select("SELECT mail FROM employe WHERE nom = ?", [ $_POST['nom'] ]);
		$ConvertToString = $ident[0]['mail'];
		$to = $ConvertToString;
		$headers = "From fabienreve@yahoo.fr \r\n";
		
		mail($to, $subject, $message, $headers);
	};
?>