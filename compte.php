<?php
	session_start();
	if( !isset( $_SESSION['idEmploye'] ) AND isset ( $_SESSION['mdp'] ) ) {
		header('Location: connexion.php');
	}
	/*try && catch permettent de gérer les erreurs
	 On crée une instance (objet $bdd) grace à 'new PDO()'
	 On signal que l'on travail avec 'mysql', que l'host est en 'localhost',
	 et que le nom de la base de données s'appel 'tuto'. Ensuite, on donne
	 le mdp de mysql et son nom: ici root(nom) et rien pour le mdp
	*/
	
	require 'incl/pdo.php';
	
	/*$req contient le resultat de la méthode de class 'query' de l'objet 'bdd'
	 le résultat dans $req n'est pas 'utilisable' en l'état
	 */
	$req = $bdd->query( 'SELECT * FROM formation' );
	//récupère le pseudo de la session pour l'afficher à côté de "Vous êtes sur votre..."
	$varID = $_SESSION['idEmploye'];
	$req2 = $bdd->query( "SELECT nom, argent, jours FROM employe WHERE idEmploye = $varID" );

	$data = $req->fetchAll();
	$data2 = $req2->fetchAll();
	//$data3 = $req3->fetchAll();
	//$data4 = $req4->fetchAll();

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
		<title></title>
	</head>
	<body>
		
		<?php include("incl/menu.php"); ?>
		<?php include("incl/menu2.php"); ?>
		<div class="container-fluid">
			<h1 style="text-align: center;">Vous êtes sur votre compte: <strong><?= $data2[0]['nom']; ?></strong></h1>
			<h1 style="text-align: center;">Argents: <strong><?= $data2[0]['argent'] ;?></strong></h1>
			<h1 style="text-align: center;">Jours: <strong><?= $data2[0]['jours'] ;?></strong></h1>
		</div>
		<?php include("incl/menuRecherche.php"); ?>
		
		<h1>Formations disponibles: </h1>
		<!-- On affiche le contenu de $data -->
		<div id="formationsList">
			<?php foreach($data as $key => $formations) :?>
			
				</br></br></br>

				<h3 style="font-size:30px;"><u><?= $formations['titre']?></u></h3>
				</br>
				<p><strong>Contenu:</strong> </p><?= $formations['contenu'] ;?>
				</br></br>
				<p><strong>Date:</strong><?= $formations['date']; ?></p>
				</br>
				<p><strong>Duree:</strong> <?= $formations['duree']; ?> h</p>
				</br>
				<p><strong>Credit:</strong> <?= $formations['credit']; ?> crédits</p>
				<!--On envoit un GET pour savoir la formation que l'utilisateur a séléctionné-->
				<a href="formation.php?idFormation=<?= $formations['idFormation'] ;?>"><i><button class="btn btn-primary">inscription</button></i></a>

			<?php endforeach;?>
		</div>
		
		<script src="js/javascript.js"></script>
	</body>
</html>