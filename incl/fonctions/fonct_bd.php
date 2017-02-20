<?php
	function bdd_select( string $query, array $params = [] ) {
	  require 'incl/fonctions/pdo.php';

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


?>