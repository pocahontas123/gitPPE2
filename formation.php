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
	 
	//récupére le pseudo de la session pour l'afficher à côté de "Vous êtes sur votre..."
	$varID = $_SESSION['idEmploye'];
	$req = $bdd->query( "SELECT nom, creditEmploye, nbJoursEmploye FROM employe WHERE idEmploye = $varID" );
	//Enregistre dans $data. Cela crée un tableau organisé
	$data = $req->fetchAll();
	
	$req3 = $bdd->query( "SELECT formation.idFormation, titre_formation, date_formation, duree_formation, contenu_formation, nbJours_formation, lieu_formation, prerequis_formation, credit_formation, selectionner.etat, prestataire.nomPrestataire from prestataire, employe join selectionner on employe.idEmploye = selectionner.idEmploye join formation on formation.idFormation = selectionner.idFormation where employe.idEmploye = $varID" );
	$data3 = $req3->fetchAll();
	
	//Si j'ai un GET c'est que quelqu'un à cliqué sur un bouton dans la page de mes formations
	if(extract($_GET)) {
		
		//5000 crédits de base
		$creditEmploye = $data[0]['creditEmploye'];
		//15 jours de base
		$nbJoursEmploye = $data[0]['nbJoursEmploye'];
		
		$coutFormation = $data3[0]['credit_formation'];
		$dureeFormation = $data3[0]['nbJours_formation'];
		
		var_dump($creditEmploye);
		var_dump($nbJoursEmploye);
		
		var_dump($coutFormation);
		var_dump($dureeFormation);
		
		//Si j'ai assé d'argents et de jours par rapport aux prix/nbjours de la formation
		if($creditEmploye >= $coutFormation && $nbJoursEmploye >= $dureeFormation) {
			//on récupère ce qui restent pour mettre à jours la BDD
			$creditEmploye = $creditEmploye-$coutFormation;
			$nbJoursEmploye = $nbJoursEmploye-$dureeFormation;
			
			//met à jours les jrs et crédit de l'employé
			$req4 = $bdd->prepare("UPDATE employe SET nbJoursEmploye = :nvJours, creditEmploye = :nvArgent WHERE idEmploye = $varID");
			$req4->execute(array(
				'nvJours' => $nbJoursEmploye,
				'nvArgent' => $creditEmploye,
			));
			
			//Rajoute la formation de l'employé
			$req2 = $bdd->prepare( 'INSERT INTO selectionner (idEmploye, idFormation, etat) VALUES (:idEmploye, :idFormation, :etat)' );
			$req2->execute(array(
				'idEmploye' => $varID,
				'idFormation' => $idFormation,
				'etat' => "En cours de validation"
			));
		}else {
			echo 'manque crédits ou jours';
		}
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
		<title></title>
	</head>
	<body>
		
		<?php include("incl/menus/menu.php"); ?>
		<?php include("incl/menus/menu2.php"); ?>
		<?php include("incl/menus/formationMenuInformation.php"); ?>

		
		<h1>Formations inscrites: </h1>
		<!-- On affiche le contenu de $data -->
		<div id="formationsInscription">
			<?php foreach($data3 as $key => $formations) :?>
			
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Titre</th>
							<th>Contenu</th>
							<th>Date</th>
							<th>Duree</th>
							<th>Nb Jours</th>
							<th>Lieu</th>
							<th>Prerequis</th>
							<th>Prestataire</th>
							<th>Etat</th>
							<th>PDF</th>
							<th>Désinscrire</th>
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
							<td><?= $formations['nomPrestataire']; ?></td>	
							<td><?= $formations['etat']; ?></td>	
							<td><i><button class="btn btn-info">Convertir pdf</button></i></td>
							<td><a href="delete.php?idFormation=<?= $formations['idFormation'] ;?>"><i><button class="btn btn-primary">Se désinscrire</button></i></a></td>
						</tr>
					</tbody>
				</table>						

			<?php endforeach;?>
		</div>		
		<script src="js/javascript.js"></script>
	</body>
</html>