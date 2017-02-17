<?php
	try {
		$connexion = "mysql:local=localhost;dbname=formationppe";
		$root = "root";
		$pw = "";
		$bdd = new PDO($connexion, $root, $pw);
	}
	catch(PDOException $e) {
		die("Erreur: "+$e->getMessage());
	}
?>
