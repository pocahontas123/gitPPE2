<?php

	//require('dbFormation.php');
	
	//Permet de RECUPERER les jours et crédits de la formation après s'être DESINSCRIT
	function ajoutJourCreditUtilisateur(int $idEmploye, int $idFormation) {
		//récupère jours (nbJours_formation) + crédits (credit_formation) de la formation
		$data = jourCreditFormation($idFormation);

        $nbJours_formation = $data[0]['nbJours_formation'];
		$credit_formation = $data[0]['credit_formation'];
		
		bdd_update( 'UPDATE employe SET nbJoursEmploye = nbJoursEmploye+:nbJours_formation, creditEmploye = creditEmploye+:credit_formation WHERE idEmploye = :idEmploye', [
			'nbJours_formation' => htmlspecialchars($nbJours_formation),
			'credit_formation' => htmlspecialchars($credit_formation),
			'idEmploye' => htmlspecialchars($idEmploye)
		] );
	};
	
	//Permet de REDUIRE les jours et crédits de la formation après s'être INSCRIT
	function soustractionJoursCreditUtilisateur(int $idEmploye, int $idFormation) {
		//récupère jours (nbJours_formation) + crédits (credit_formation) de la formation
		$data = jourCreditFormation($idFormation);

        $nbJours_formation = $data[0]['nbJours_formation'];
		$credit_formation = $data[0]['credit_formation'];

		bdd_update( 'UPDATE employe SET nbJoursEmploye = nbJoursEmploye-:nbJours_formation, creditEmploye = creditEmploye-:credit_formation WHERE idEmploye = :idEmploye', [
			'nbJours_formation' => htmlspecialchars($nbJours_formation),
			'credit_formation' => htmlspecialchars($credit_formation),
			'idEmploye' => htmlspecialchars($idEmploye)
		] );
	};
	
	//Permet de réinitialiser les jours et crédits de l'utilisateur le 1er janvier
	function reinitialiserJoursCreditUtilisateur(int $idEmploye) {
		
		$creditEmploye = 5000;
		$nbJoursEmploye = 15;
		
		bdd_update( 'UPDATE employe SET creditEmploye=:creditEmploye, nbJoursEmploye=:nbJoursEmploye WHERE idEmploye=:idEmploye', [
			'creditEmploye' => htmlspecialchars($creditEmploye),
			'nbJoursEmploye' => htmlspecialchars($nbJoursEmploye),
			'idEmploye' => htmlspecialchars($idEmploye)
		] );
	};
	
	//Récupère login, jours et crédits de l'utilisateur pour le menu 'Bienvenu $votrePseudo'
	function getNomJoursCredit(int $idEmploye) : array{
		$data = bdd_select( 'SELECT login, creditEmploye, nbJoursEmploye FROM employe WHERE idEmploye =?', [$idEmploye] );
		return $data;
	};
	
	//Savoir si j'ai assez de jours et de crédit pour avoir une formation
	function suffisanceJoursCreditUtilisateur(array $joursCreditFormation, int $idEmploye) : bool{
		$data = getNomJoursCredit($idEmploye);
		if($data[0]['creditEmploye'] >= $joursCreditFormation[0]['credit_formation'] && $data[0]['nbJoursEmploye'] >= $joursCreditFormation[0]['nbJours_formation']) {
			return true;
		}else {
			return false;
		}
	};
		
?>