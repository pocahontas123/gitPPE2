<?php
	try {
		$connexion = "mysql:local=localhost;dbname=formationppe";
		$root = "root";
		$pw = "";
		//
		$utf = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
		$bdd = new PDO($connexion, $root, $pw, $utf);
	}
	catch(PDOException $e) {
		die("Erreur: "+$e->getMessage());
	}
?>
