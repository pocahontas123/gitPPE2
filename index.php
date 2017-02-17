<?php
	session_start();
	if( !isset( $_SESSION['idEmploye'] ) AND !isset ( $_SESSION['mdp'] ) ) {
		header('Location: login.php');
	}
	
	/*try && catch permettent de gérer les erreurs
	 On crée une instance (objet $bdd) grace à 'new PDO()'
	 On signal que l'on travail avec 'mysql', que l'host est en 'localhost',
	 et que le nom de la base de données s'appel 'tuto'. Ensuite, on donne
	 le mdp de mysql et son nom: ici root(nom) et rien pour le mdp
	*/
	
	require 'incl/fonctions/pdo.php';
	
	
	
	/*$req contient le resultat de la méthode de class 'query' de l'objet 'bdd'
	 le résultat dans $req n'est pas 'utilisable' en l'état
	 */
	$req = $bdd->query( 'SELECT * FROM formation WHERE date_formation >= NOW()' );
	
	//récupère le pseudo de la session pour l'afficher à côté de "Vous êtes sur votre..."
	$varID = $_SESSION['idEmploye'];
	$req2 = $bdd->query( "SELECT nom, creditEmploye, nbJoursEmploye FROM employe WHERE idEmploye = $varID" );

	$data = $req->fetchAll();
	$data2 = $req2->fetchAll();
	//$data3 = $req3->fetchAll();
	//$data4 = $req4->fetchAll();
	
	$req3 = $bdd->query( 'SELECT YEAR(date_creation) FROM tabledate' );
	$date = $req3->fetchAll();
	$anneeActuelle = date("Y");
	$dateActuelle = date("Y")."-01-01";
	$anneeBD = $date[0]['YEAR(date_creation)'];
	
	if( $anneeActuelle > $anneeBD ) {
		$req3 = $bdd->prepare( "UPDATE employe SET creditEmploye = 5000, nbJoursEmploye = 15 WHERE idEmploye = :idEmploye" );	
		$req3->execute(array(
			'idEmploye' => $_SESSION['idEmploye']
		));
		
		
		$req3 = $bdd->prepare( "UPDATE tabledate SET date_creation =  :dateActuelle WHERE id = 1" );		
		$req3->execute(array(
			'dateActuelle' => $dateActuelle
		));
	}
?>

<!DOCTYPE html>
<html>
	<head lang="fr">
		<meta charset="utf-8"/>
		<meta name="description" content="Guillou Fabien ppe2 bts stg sio slam option"/>
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

		<?php include("incl/menus/menu.php"); ?>
		<?php include("incl/menus/menu2.php"); ?>
		<?php include("incl/menus/indexMenuInformation.php"); ?>
		<?php include("incl/menus/menuRecherche.php"); ?>
		
		<h1>Formations disponibles: </h1>
		<!-- On affiche le contenu de $data -->
		<div id="formationsList1">
			<?php foreach($data as $key => $formations) :?>
			
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Titre</th>
							<th>Contenu</th>
							<th>Date</th>
							<th>Duree</th>
							<th>Nb Jours</th>
							<th>Lieu</th>
							<th>Prérequis</th>
							<th>Crédit(s)</th>
							<th>Inscription</th>
							<th>PDF</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><strong><?= $formations['titre_formation']; ?></strong></td>
							<td><?= $formations['contenu_formation'] ;?></td>
							<td><?= $formations['date_formation']; ?></td>
							<td><?= $formations['duree_formation']; ?></td>
							<td><?= $formations['nbJours_formation']; ?></td>
							<td><?= $formations['lieu_formation']; ?></td>
							<td><?= $formations['prerequis_formation']; ?></td>
							<td><?= $formations['credit_formation']; ?></td>
							<td><a href="formation.php?idFormation=<?= $formations['idFormation'] ;?>"><i><button class="btn btn-primary">inscription</button></i></a></td>
							<td><i><button class="btn btn-info">Convertir pdf</button></i></td>
						</tr>
					</tbody>
				</table>						

			<?php endforeach;?>
		</div>
		<script src="js/javascript.js"></script>
	</body>
</html>