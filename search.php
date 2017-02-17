<?php
	session_start();
	if( !isset( $_SESSION['idEmploye'] ) AND isset ( $_SESSION['mdp'] ) ) {
		header('Location: connexion.php');
	}
	if(empty($_POST) || empty($_POST['search'])) {
		header("Location: compte.php");
	}else {
		extract($_POST);
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
	$req = $bdd->query("SELECT * FROM formation WHERE titre LIKE '%$search%' ORDER BY idFormation");
	//On compte le nombre d'éléments
	$count = $req->rowCount();
	//On récupère tout
	$data = $req->fetchAll();
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
		<style>
			#formationsList{
				height: 500px;
				width: 500px;
				word-wrap: break-word;
				position: relative;
				margin-left: 20px;
				
			}
			p button {
				position: relative;
				top: -200px;
				margin-left: 500px;
				margin-top: 120px;
				font-size: 20px;
			}
			p button a {
				color: white;
			}
		</style>
	</head>
	<body>
		<?php include("incl/menu.php"); ?>
		<?php include("incl/menu2.php"); ?>
		
		<?php
			if(!empty($req))
			{
				?>
				<h1 style="font-size: 2em;">Formation(s) trouvée(s): <?= $count ?></h1>
				<br/>
				<!-- On affiche le contenu de $data -->
				<div id="formationsList">
					<?php foreach($data as $key => $article) :?>
						<br/><br/>
						<?php var_dump($article['idFormation']);?>
						<h3 style="font-size: 1.17em;"><?= $article['titre']?></h3>
						<p><h4>Contenu de la formation:</h4> <?= $article['contenu'] ?></p>
						<a href="formation.php?idFormation=<?= $article['idFormation'] ;?>"><i><button class="btn btn-primary">inscription</button></i></a>
					<?php endforeach;?>
				
				<?php
			}
			else
			{
			  echo '<h2>Aucun resultat</h2>';
			}
		?>
		<br/>
		<br/>
		<p><a href="compte.php"><button class="btn btn-primary">Page de recherche</button></a></p>
		
		<script src="js/javascript.js"></script>
	</body>
</html>