<?php
	session_start();
	if( !isset( $_SESSION['idEmploye'] ) AND !isset ( $_SESSION['mdp'] ) ) {
		header('Location: login.php');
	}
	
	$idEmploye = $_SESSION['idEmploye'];
	
	require 'incl/fonctions/pdo.php';
	require 'incl/fonctions/fonct_date.php';
	require 'incl/fonctions/dbFormation.php';
	require 'incl/fonctions/dbSelectionner.php';
	require 'incl/fonctions/dbUtilisateur.php';
	
	if( date('d') == 1 AND date('m') == 1 ) {
		reinitialiserJoursCreditUtilisateur($idEmploye);
	}	
	extract($_GET);
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
		<?php
			if ( !isset( $_GET['inscription'] ) AND empty( $_GET['inscription'] )) {
				if ( isset( $_GET['formation'] ) AND $_GET['formation'] == 1) {
					include("mesFormation.php");
				}

				elseif ( isset( $_GET['formation'] ) AND $_GET['formation'] == 2 ) {
					include("formationDisponible.php");
				}

				elseif ( isset( $_GET['formation'] ) AND $_GET['formation'] == 3 ) {
					include("historiqueFormation.php");
				}

				elseif ( isset( $_GET['formation'] ) AND $_GET['formation'] == 4 ) {
					include("search.php");
					
				}else {
					include("mesFormation.php");
				}
				
			}elseif ( isset( $_GET['inscription'] ) AND $_GET['inscription'] == 1 AND isset( $_GET['idFormation'] ) ) {
				//Si j'ai une inscription = '1' cela veut dire que je m'INSCRIS à une formation
				
				//Récupère le prix en crédits et jours de la formation dans un array $data
				$joursCreditFormation = jourCreditFormation($idFormation);

				//suffisanceJoursCreditUtilisateur($idEmploye) return 'true' si j'ai assez pour la formation ou 'false' si non
				If ( suffisanceJoursCreditUtilisateur($joursCreditFormation, $idEmploye) ) {
					//Si 'true', je rajoute ma formation avec 'ajoutSelection()'
					ajoutSelection($idEmploye, $idFormation);
					
					//Ensuite je déduis le coût de celle-ci avec 'soustractionJoursCreditUtilisateur()'
					soustractionJoursCreditUtilisateur($idEmploye, $idFormation);
					
					if ( isset( $_GET['formation'] ) AND $_GET['formation'] == 1) {
						include("mesFormation.php");
					}

					elseif ( isset( $_GET['formation'] ) AND $_GET['formation'] == 2 ) {
						include("formationDisponible.php");
					}

					elseif ( isset( $_GET['formation'] ) AND $_GET['formation'] == 3) {
						include("historiqueFormation.php");
					}

					elseif ( isset( $_GET['formation'] ) AND $_GET['formation'] == 4 ) {
						include("search.php");
					
					}else {
						include("mesFormation.php");
					}
				
				//Si 'false' alors j'ai pas assez de crédits ou de jours pour m'inscrire à la formation
				}else {
					echo ('Manque des crédits ou des jours pour m\'inscrire à la formation');
					
					if ( isset( $_GET['formation'] ) AND $_GET['formation'] == 1 ) {
						include("mesFormation.php");
					}

					elseif ( isset( $_GET['formation'] ) AND $_GET['formation'] == 2 ) {
						include("formationDisponible.php");
					}

					elseif ( isset( $_GET['formation'] ) AND $_GET['formation'] == 3) {
						include("historiqueFormation.php");
					}

					elseif ( isset($_GET['formation'] ) AND $_GET['formation'] == 4 ) {
						include("search.php");
					
					}else {
						include("mesFormation.php");
					}
				}
				
			//Si j'ai une inscription = '0' alors je me DESINSCRIS
			}elseif ( isset( $_GET['inscription'] ) AND $_GET['inscription'] == 0 AND isset( $_GET['idFormation'] ) ) {
				//Je supprime ma formation de la table 'selectionner'
				supprimerSelection($idEmploye, $idFormation);
				
				//Je récupère mes crédits et jours dépensés
				ajoutJourCreditUtilisateur($idEmploye, $idFormation);
				
				//Message de confirmation de la désinscription
				echo 'Désinscription à votre formation OK';

				if ( isset($_GET['formation'] ) AND $_GET['formation'] == 1 ) {
					include("mesFormation.php");

				}
				
				elseif ( isset($_GET['formation'] ) AND $_GET['formation'] == 2 ) {
					include("formationDisponible.php");
				}

				elseif ( isset( $_GET['formation']) AND $_GET['formation'] == 3 ) {
					include("historiqueFormation.php");
				}

				elseif ( isset( $_GET['formation'] ) AND $_GET['formation'] == 4 ) {
					include("search.php");
					
				}else {
					include("mesFormation.php");
				}
			}
		?> 
		<script src="js/javascript.js"></script>
	</body>
</html>