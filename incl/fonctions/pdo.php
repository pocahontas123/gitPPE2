<?php

	/*
	try {
		//$connexion = "mysql:local=localhost;dbname=formationppe";
		$connexion = "mysql:host=db669846089.db.1and1.com;dbname=db669846089;charset=utf8";
		$root = "dbo669846089";
		$pw = "wwwwwww";
		//Gère caractère spéciaux en forme de "??? ???"
		$utf = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
		$bdd = new PDO($connexion, $root, $pw, $utf);
	}
	catch(PDOException $e) {
		die("Erreur: "+$e->getMessage());
	}
	*/
	try {
		//Gère caractère spéciaux en forme de "??? ???"
		$utf = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
		$bdd = new PDO("mysql:local=localhost;dbname=formationppe;charset=utf8", "root", "");
	}
	catch(PDOException $e) {
		die("Erreur: "+$e->getMessage());
	}
	
?>
