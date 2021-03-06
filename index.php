﻿<?php
	session_start();
?>
<?php
	if( !isset($_SESSION['idEmploye'])AND !isset($_SESSION['mdp'])){
		echo '<script>window.location.replace("login.php")</script>';
		//header('Location: login.php', true);
	}
	
	
	$idEmploye = $_SESSION['idEmploye'];
	$typeEmploye = $_SESSION['typeEmploye'];
	
	require 'incl/fonctions/pdo.php';
	require 'incl/fonctions/fonct_date.php';
	require 'incl/fonctions/dbFormation.php';
	require 'incl/fonctions/dbSelectionner.php';
	require 'incl/fonctions/dbUtilisateur.php';
	
	//Si je suis le 01/01 de l'année en cours
	if( date('d') == 1 AND date('m') == 1 ) {
		$data = reinitialiserOuiOuNon($idEmploye);
		//et que j'ai true
		if($data[0] == 1) {
			//alors je réinitialise les crédits
			reinitialiserJoursCreditUtilisateur($idEmploye);
			//et je mets ma valeur à false (0)
			reinitialiserNon($idEmploye);
		}
	//si je ne suis plus le 01/01 de l'année en cours
	}else {
		//alors je remplace ma valeur en true comme cela je pourrais re-rentrer dans le premier et deuxième IF le moment voulu
		reinitialiserOui($idEmploye);
	}
	
	extract($_GET);
	
	//Si je reçois les 3 informations de mon $_GET de 'mesEmployes2.php' du bouton 'valider'
	if( isset($_GET['idFormation']) AND isset($_GET['idEmploye']) AND isset($_GET['formation']) AND $_GET['formation'] == 5 ) {
		
		//Je valide la formation de l'employé
		validerSelection($idEmploye, $idFormation);	
		
		echo '<script>alert("Vous avez validé la formation '.$titre_formation.' de : '.$nomEmploye.'-'.$prenomEmploye.'")</script>';
		//header("Refresh: 0; url=index.php?formation=$formation");
		//header( "Location: index.php?formation=$formation" );
		echo '<script>window.location.replace("index.php?formation=2")</script>';
	}
?>

<!DOCTYPE html>
<html>
	<head lang="fr">
	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
		
		<title>PPE2 Maison des ligues</title>
		
	</head>
	<body>
		
		<?php include("incl/menus/menu.php"); ?>
		<?php
			//Si je n'ai pas de variable 'inscription' c'est que je n'essaie pas de m'inscrire ou me désinscrire d'une formation
			if ( !isset( $_GET['inscription'] ) AND empty( $_GET['inscription'] )) {
				
				//Gestion basique. Si j'ai formation = 1, je dois afficher 'mesFormation.php'
				if ( isset( $_GET['formation'] ) AND $_GET['formation'] == 1) {
					include("mesFormation.php");
				}
				
				//Si j'ai formation = 2, je dois afficher 'formationDisponible.php'
				elseif ( isset( $_GET['formation'] ) AND $_GET['formation'] == 2 ) {
					include("formationDisponible.php");
				}
				
				//Si j'ai formation = 3, je dois afficher 'historiqueFormation.php'
				elseif ( isset( $_GET['formation'] ) AND $_GET['formation'] == 3 ) {
					include("historiqueFormation.php");
				}

				//Si j'ai formation = 4, je dois afficher 'search.php'
				elseif ( isset( $_GET['formation'] ) AND $_GET['formation'] == 4 ) {
					include("search.php");
				
				
				//Accessible pour un chef d'équipe 'Formation(s) de mes employés
				}elseif ( isset ($_GET['formation'] ) AND $_GET['formation'] == 5 AND $typeEmploye == 2 ) {
					
					//mesEmploye.php
					include("mesEmployes.php");
				
				}elseif ( isset ($_GET['formation'] ) AND $_GET['formation'] == 6 AND $typeEmploye == 2 AND $_GET['idEmploye'] ) {
					
					//changer par formationMesEmployes.php
					include("formationsMesEmployes.php");

				//Par défaut (pour finir la condition), j'affiche 'mesFormation.php'
				}else {
					include("mesFormation.php");
				}
				
			//Si j'ai une inscription = '1' cela veut dire que je m'INSCRIS à une formation	
			}elseif ( isset( $_GET['inscription'] ) AND $_GET['inscription'] == 1 AND isset( $_GET['idFormation'] )  AND rechercheIdFormation( $_GET['idFormation'] ) ) {
				
				//Récupère le prix en crédits et jours de la formation dans un array $data
				$joursCreditFormation = jourCreditFormation($idFormation);

				//suffisanceJoursCreditUtilisateur($idEmploye) return 'true' si j'ai assez pour la formation ou 'false' si non
				If ( suffisanceJoursCreditUtilisateur($joursCreditFormation, $idEmploye) ) {
					//Si 'true', je rajoute ma formation avec 'ajoutSelection()'
					ajoutSelection($idEmploye, $idFormation, $typeEmploye);
					
					//Ensuite je déduis le coût de celle-ci avec 'soustractionJoursCreditUtilisateur()'
					soustractionJoursCreditUtilisateur($idEmploye, $idFormation);
					
					$nomFormation = rechercheNomFormation($idFormation);
					$nomFormation = $nomFormation[0]['titre_Formation'];
					
					//Message de confirmation de la désinscription	
					echo '<script>alert("Vous venez de vous inscrire à la formation: '.$nomFormation.'")</script>';
					
					//récupère le numéro 'formation ' pour savoir où rediriger avec le header()
					$formation = $_GET['formation'];
					//header( "Refresh: 0; url=index.php?formation=$formation" );
					echo '<script>window.location.replace("index.php?formation=2")</script>';
				
				//Si 'false' alors j'ai pas assez de crédits ou de jours pour m'inscrire à la formation
				}else {
					$nomFormation = rechercheNomFormation($idFormation);
					$nomFormation = $nomFormation[0]['titre_Formation'];
					
					//Message de confirmation de la désinscription	
					echo '<script>alert("Vous n\'avez pas suffisement de jours ou de crédits pour vous inscrire à cette formation: '.$nomFormation.'")</script>';
					$formation = $_GET['formation'];
					//header( "Refresh: 0; url=index.php?formation=$formation" );
					echo '<script>window.location.replace("index.php?formation=2")</script>';
					
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
			}elseif ( isset( $_GET['inscription'] ) AND $_GET['inscription'] == 0 AND isset( $_GET['idFormation'] ) AND rechercheIdFormation($_GET['idFormation'])) {
				
				//Je supprime ma formation de la table 'selectionner'
				supprimerSelection($idEmploye, $idFormation);

				//Je récupère mes crédits et jours dépensés
				ajoutJourCreditUtilisateur($idEmploye, $idFormation);
				
				$nomFormation = rechercheNomFormation($idFormation);
				$nomFormation = $nomFormation[0]['titre_Formation'];
				
				//Message de confirmation de la désinscription	
				$formation = $_GET['formation'];
				echo '<script>alert("Vous êtes désinscrit de la formation: '.$nomFormation.'")</script>';
				//header("Refresh: 0; url=index.php?formation=$formation");
				echo '<script>window.location.replace("index.php?formation=2")</script>';
				
			}else {
                include("mesFormation.php");
            }
		?> 
		<script src="js/javascript.js"></script>
		<script>
		
			//Permet d'avoir le titre de la page en sous ligné jaune
			$(document).ready(function(){
				var url = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
				$('ol.breadcrumb li a[href$="'+url+'"]').parent().addClass("yellowMenu");
			});
			
		</script>
	</body>
</html>