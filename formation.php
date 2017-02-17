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
	 
	//récupére le pseudo de la session pour l'afficher à côté de "Vous êtes sur votre..."
	$varID = $_SESSION['idEmploye'];
	$req = $bdd->query( "SELECT nom, argent, jours FROM employe WHERE idEmploye = $varID" );
	//Enregistre dans $data. Cela crée un tableau organisé
	$data = $req->fetchAll();
	
	$req3 = $bdd->query( "SELECT titre, date, duree, contenu, nbJours, lieu, prerequis, credit, prestataire.nom from prestataire, employe join selectionner on employe.idEmploye = selectionner.idEmploye join formation on formation.idFormation = selectionner.idFormation where employe.idEmploye = $varID" );
	$data3 = $req3->fetchAll();
	
	//Si j'ai un GET c'est que quelqu'un à cliqué sur un bouton dans la page de mes formations
	if(extract($_GET)) {
		
		//5000 crédits de base
		$argent = $data[0]['argent'];
		//15 jours de base
		$jours = $data[0]['jours'];
		
		$coutFormation = $data3[0]['credit'];
		$dureeFormation = $data3[0]['nbJours'];
		
		var_dump($argent);
		var_dump($jours);
		
		var_dump($coutFormation);
		var_dump($dureeFormation);
		
		//Si j'ai assé d'argents et de jours par rapport aux prix/nbjours de la formation
		if($argent >= $coutFormation && $jours >= $dureeFormation) {
			//on récupère ce qui restent pour mettre à jours la BDD
			$argent = $argent-$coutFormation;
			$jours = $jours-$dureeFormation;
			
			//met à jours les jrs et crédit de l'employé
			$req4 = $bdd->prepare("UPDATE employe SET jours = :nvJours, argent = :nvArgent WHERE idEmploye = $varID");
			$req4->execute(array(
				'nvJours' => $jours,
				'nvArgent' => $argent,
			));
			
			//Rajoute la formation de l'employé
			$req2 = $bdd->prepare( 'INSERT INTO selectionner (idEmploye, idFormation) VALUES (:idEmploye, :idFormation)' );
			$req2->execute(array(
				'idEmploye' => $varID,
				'idFormation' => $idFormation,
			));
		}else {
			echo 'manque argent ou jours';
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
		
		<?php include("incl/menu.php"); ?>
		<?php include("incl/menu2.php"); ?>
		<div class="container-fluid">
			<h1 style="text-align: center;">Vous étes sur votre compte: <strong><?= $data[0]['nom']; ?></strong></h1>
			<h1 style="text-align: center;">Argents: <strong><?= $data[0]['argent']; ?></strong></h1>
			<h1 style="text-align: center;">Jours: <strong><?= $data[0]['jours']; ?></strong></h1>
		</div>
		
		<h1>Formations inscrites: </h1>
		<!-- On affiche le contenu de $data -->
		<div id="formationsInscription">
			<?php foreach($data3 as $key => $formations) :?>
			
				</br></br></br>
				<!-- Le titre de l'article en titre -->
				<h3 style="font-size:30px;"><u><?= $formations['titre'] ;?></u></h3>
				</br>
				<p><strong>Contenu:</strong> </p><?= $formations['contenu'] ;?>
				</br></br>
				<p><strong>Date:</strong> <?= $formations['date'] ;?></p>
				</br>
				<p><strong>Durée(h):</strong> <?= $formations['duree'] ;?> h </p>
				</br/>
				<p><strong>Nb Jours:</strong> <?= $formations['nbJours'] ;?> j</p>	
				</br>
				<p><strong>Lieu :</strong> <?= $formations['lieu'] ;?> </p>	
				</br>
				<p><strong>Prerequis :</strong> <?= $formations['prerequis'] ;?> </p>	
				</br>
				<p><strong>Prestataire:</strong> <?= $formations['nom'] ;?></p>

				
			<?php endforeach;?>
		</div>	
		<script src="js/javascript.js"></script>
	</body>
</html>