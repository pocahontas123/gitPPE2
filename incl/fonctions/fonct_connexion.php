<?php

	function account_exists() : array{
		$membre = bdd_select( 'SELECT idEmploye, mdp, typeEmploye FROM employe WHERE login = ?', [$_POST['login']] );
		
		//Si j'ai une concordance de mail entre la BDD et le formulaire, je vérifie que le mdp du formulaire est pareil que la BDD
		if( !empty ($membre) && ($_POST['mdp'] == $membre[0]['mdp'])) {
			//si ok, je retourne toutes les infos
			return $membre[0];
		}else {
			//sinon je retourne un tableau vide (donc aucune info sous la forme d'un tableau)
			return [];
		}
	};



?>