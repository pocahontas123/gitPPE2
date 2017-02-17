<?php
	//demarre la session
	session_start();
	//Si j'ai SESSION id et password, c'est que je suis co donc je n'ai rien à faire dans 'oubli.php'
	if( isset( $_SESSION['idEmploye'] ) AND isset( $_SESSION['mdp'] ) )  {
		header("Location: compte.php");
	}

?>
<?php
	//Si mon formulaire n'est pas vide
	if( !empty( $_POST ) ) {
		//J'extrais mes données du formulaire sous la forme '$identifiant' et '$password'
		extract( $_POST );
		//lien avec ma page de fonctions
		require_once ('incl/functions.php');
		//tableau associatif qui contiendra les erreurs
		$erreur = [];
		//Si identifiant dans mon form. est vide alors 'il n'est pas fourni'
		if( empty( $nom ) ) {
			$erreur['nom'] = "L'identifiant n'est pas fourni";
		}elseif( !identifiant_exists()) {
			$erreur['nom'] = "L'identifiant n'existe pas";
		}
		
		//Si le tableau n'a pas d'erreurs, formulaire OK !
		if( !$erreur ) {
			$subject = "Mot de passe perdu";
			var_dump($_POST['nom']);
			$membre = bdd_select( 'SELECT mdp FROM employe WHERE nom = ?', [$_POST['nom']] );
			if( !empty ($membre) ) {
	

				$mdp = $membre[0]['mdp'];
				$message ="Votre mdp est $mdp";
				mail_html($subject, $message);
				
				$validation = "Mail envoyé !";
				unset($nom);
			}
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
		<div class="container-fluid">
			<div id="formConnexion2" class="row">	
				<div id="form2">
					<form id="form" class="form-horyzontal" role="form" action="oubli.php" method="POST">
						<h1>Oubli</h1>
						
						
						<?php if( isset($erreur['nom']) ) :?>
							<div id="erreurEmail" class="btn btn-danger"><?= $erreur['nom'] ?></div>
						<?php endif; ?><br/>

						<?php if( isset($validation) ) :?>
							<div id="erreurEmail" class="btn btn-success"><?= $validation ?></div>
						<?php endif; ?><br/>
						
						<br/><br/>
						<div class="input-group margin-bottom-sm">
						  <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
						  <input class="form-control" type="text" id="text2" name="nom" placeholder="Identifiant..." value="<?php if(isset( $nom  ) ) :?><?= $nom; ?><?php endif; ?>"/>
						</div>
						<br/><br/>
						</div>
						<br/><br/><br/>
						<div class="input-group margin-bottom-sm">
						  <button type="submit" id="submit2" class="btn btn-primary form-control">Envoyez</button>
						</div>	
					</form>	
				</div>
			</div>
		</div>
		<script src="js/javascript.js"></script>
	</body>
</html>