<?php
	session_start();
	
	if( !isset( $_SESSION['idEmploye'] ) AND !isset ( $_SESSION['mdp'] ) ) {
		header('Location: login.php');
	}
	
	require 'incl/fonctions/pdo.php';
	
	extract($_GET);
	
	$req = $bdd->prepare( "DELETE FROM selectionner WHERE idFormation = :idFormation" );
	$req->execute(array(
		'idFormation' => htmlspecialchars($idFormation)
	));
	
	header('Location: formation.php');
?>