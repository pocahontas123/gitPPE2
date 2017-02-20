<?php
	
	//Gère les requêtes de type 'SELECT' dans la base de données
	function bdd_select( string $query, array $params = [] ) : array {
		require 'pdo.php';

		if ( $params ) {
			$req = $bdd->prepare( $query );
			$req->execute( $params );
		}
		else {
			$req = $bdd->query( $query );
		}
		
		$data = $req->fetchAll();
		
		$req->closeCursor();
		
		return $data;
	};
	
	//Gère les requêtes de type 'DELETE' dans la base de données
	function bdd_delete( string $query, array $params = [] ) {
		require 'pdo.php';

		if ( $params ) {
			$req = $bdd->prepare( $query );
			$req->execute( $params );
		}
		else {
			$req = $bdd->query( $query );
		}
		$req->closeCursor();
	};
	
	//Gère les requêtes de type 'UPDATE' dans la base de données
	function bdd_update( string $query, array $params = [] ) {
		require 'pdo.php';

		if ( $params ) {
			$req = $bdd->prepare( $query );
			$req->execute( $params );
		}
		else {
			$req = $bdd->query( $query );
		}
		$req->closeCursor();
	};
	
	//Gère les requêtes de type 'INSERT' dans la base de données
	function bdd_insert( string $query, array $params = [] ) {
		require 'pdo.php';

		if ( $params ) {
			$req = $bdd->prepare( $query );
			$req->execute( $params );
		}
		else {
			$req = $bdd->query( $query );
		}
		$req->closeCursor();
	};

?>