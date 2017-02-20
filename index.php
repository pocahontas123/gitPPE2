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
				if (!isset($_GET['inscription']) AND empty($_GET['inscription'])) {
					if (isset($_GET['formation']) AND $_GET['formation']==1) {
						include("mesFormation.php");
					}
					
					elseif (isset($_GET['formation']) AND $_GET['formation']==2) {
						include("formationDisponible.php");
					}

					elseif (isset($_GET['formation']) AND $_GET['formation']==3) {
						include("historiqueFormation.php");
					}

					elseif (isset($_GET['formation']) AND $_GET['formation']==4) {
						include("search.php");
					}
					else
					{
						include("mesFormation.php");
					}
				}
				elseif (isset($_GET['inscription']) AND $_GET['inscription']==1 AND isset($_GET['idFormation']) {
					// vérification de nbjour et crédit suffisant pour l'employé pour cette formation :
					//Appel à la fonction JourCreditFormation($idFormation) du fichier dbFormation.php pour avoir le crédit et la duree de la formation
					$joursCreditFormation = jourCreditFormation($idFormation);
				
					//appel de la fonction suffisanceJoursCreditUtilisateur($idEmploye) qui doit être créée dans le fichier dbUtilisateur.php . cette fonction va nous renvoyer un booléen vrai si jour crédit suffisant faux sinon
					if(suffisanceJoursCreditUtilisateur($joursCreditFormation, $idEmploye)) {
						//faire le point 10 du mail précédent
						ajoutSelection($idEmploye, $idFormation);
						soustractionJoursCreditUtilisateur($idEmploye, $idFormation);
						
						if(isset($_GET['formation'] AND $_GET['formation']==1) {
							include('mesFormation.php');
						
						}elseif (isset($_GET['formation']) AND $_GET['formation']==2) {
							include("formationDisponible.php");
						}

						elseif (isset($_GET['formation']) AND $_GET['formation']==3) {
							include("historiqueFormation.php");
						}

						elseif (isset($_GET['formation']) AND $_GET['formation']==4) {
							include("search.php");
						}
						else {
							include("mesFormation.php");
						}
					}
					else
					{
						//afficher un message d'erreur
						echo 'ERREUR';
					}
					
					if(isset($_GET['formation']) AND $_GET['formation']==1) {
						include("mesFormation.php");
					}

					elseif (isset($_GET['formation']) AND $_GET['formation']==2) {
						include("formationDisponible.php");
					}

					elseif (isset($_GET['formation']) AND $_GET['formation']==3) {
						include("historiqueFormation.php");
					}

					elseif (isset($_GET['formation']) AND $_GET['formation']==4) {
						include("search.php");
					}
					else {
						include("mesFormation.php");
					}
					}

					}
					elseif (isset($_GET['inscription']) AND $_GET['inscription']==0 AND isset($_GET['idFormation'])
					{
						// faire le point 9 du mail précédent
						// message indiquant la bonne désincription
						supprimerSelection($idEmploye, $idFormation);
						ajoutJourCreditUtilisateur($idEmploye, $idFormation);
						echo 'Désinscription ok';
				}
				
				
				 if (isset($_GET['formation']) AND $_GET['formation']==1) {
					include("mesFormation.php");
				}

				elseif (isset($_GET['formation']) AND $_GET['formation']==2) {
					include("formationDisponible.php");
				}

				elseif (isset($_GET['formation']) AND $_GET['formation']==3) {
					include("historiqueFormation.php");
				}

				elseif (isset($_GET['formation']) AND $_GET['formation']==4) {
					include("search.php");
				}
				else
				{
				include("mesFormation.php");
				}
				}

				}
?> 
		<script src="js/javascript.js"></script>
	</body>
</html>