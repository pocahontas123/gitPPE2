<?php

	//Supprime une ligne dans la table 'selectionner'
	function supprimerSelection(int $idEmploye, int $idFormation) {
		include('pdo.php');
		
		bdd_delete( 'DELETE FROM selectionner WHERE idEmploye=:idEmploye AND idFormation=:idFormation', [
			'idEmploye' => htmlspecialchars($idEmploye),
			'idFormation' => htmlspecialchars($idFormation)
		] );
	};
	
	//Ajoute un formation à l'employer dans 'Mes formation(s)' sous le status 'En cours'
	function ajoutSelection(int $idEmploye, int $idFormation) {
		include('pdo.php');
		
		$message = 'En cours';
		
		bdd_insert( 'INSERT INTO selectionner  VALUES(:idEmploye, :idFormation, :message)', [
			'idEmploye' => htmlspecialchars($idEmploye),
			'idFormation' => htmlspecialchars($idFormation),
			'message' => htmlspecialchars($message)
		] );	
	};
	
?>