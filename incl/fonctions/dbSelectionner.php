<?php

	//Supprime une ligne dans la table 'selectionner'
	function supprimerSelection( int $idEmploye, int $idFormation ) {
		include('pdo.php');

		bdd_delete( 'DELETE FROM selectionner WHERE idEmploye=:idEmploye AND idFormation=:idFormation', [
			'idEmploye' => htmlspecialchars($idEmploye),
			'idFormation' => htmlspecialchars($idFormation)
		] );
	};
	
	//Ajoute un formation à l'employer dans 'Mes formation(s)' sous le status 'En cours'
	function ajoutSelection( int $idEmploye, int $idFormation, int $typeEmploye ) {
		include('pdo.php');
		
		if( $typeEmploye == 3 ) {	
			$message = 'En cours';
		//directement valider la formation pour un chef
		}elseif( $typeEmploye == 2 ) {
			$message = 'Validée';
		}
		
		bdd_insert( 'INSERT INTO selectionner  VALUES(:idEmploye, :idFormation, :message)', [
			'idEmploye' => htmlspecialchars($idEmploye),
			'idFormation' => htmlspecialchars($idFormation),
			'message' => htmlspecialchars($message)
		] );	
	};
	
	//Chef de projet qui change l'état d'une formation de 'En cours' à 'Validée'
	function validerSelection( int $idEmploye, int $idFormation ) {
		include('pdo.php');
		
		$message = 'Validée';
		
		bdd_update( 'UPDATE selectionner SET selectionner.etat = :message WHERE idEmploye = :idEmploye AND idFormation = :idFormation', [
					'message' => $message,
					'idEmploye' => $idEmploye,
					'idFormation' => $idFormation
		] );
	};
	
?>