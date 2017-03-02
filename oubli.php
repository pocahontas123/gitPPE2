<?php

	//demarre la session
	session_start();
	
	//Si j'ai SESSION id et password, c'est que je suis co donc je n'ai rien ࡦaire dans 'oubli.php'
	if( isset( $_SESSION['idEmploye'] ) AND isset( $_SESSION['mdp'] ) )  {
		header("Location: index.php");
	}
	
?>

<!DOCTYPE html>
<html>
	<head lang="fr">
	
		<meta charset="utf-8"/>
		<meta name="description" content=" Guillou Fabien ppe2 bts stg sio slam option"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
		
		 <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
		<!-- Latest animated.css -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css"/>
		<!-- Latest font-awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"/> 
		
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>	
		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
		<!-- CSS -->
		<link rel="stylesheet" href="css/reset.css"/>
		<link rel="stylesheet" href="css/stylesheet.css"/>
		
		<title>PPE2- Maison des ligues</title>
		
	</head>
<?php

	extract($_GET);
	
	//Gestion de la page oubli de mdp
	if ( isset( $_GET['oubli'] ) AND $_GET['oubli'] == 1 ) {
		include("oubliNom.php");
		
	}elseif ( isset( $_GET['oubli'] ) AND $_GET['oubli'] == 2 ) {
		include("oubliMail.php");
	
	}else {
		include("oubliNom.php");
	}	
	
?>
