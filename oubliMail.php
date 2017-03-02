<?php
	//Si mon formulaire n'est pas vide
	if( !empty( $_POST ) ) {
		
		//J'extrais mes données du formulaire sous la forme '$identifiant' et '$password'
		extract( $_POST );
		
		
		//lien avec ma page de fonctions
		require_once ('incl/fonctions/fonct_bd.php');
		require_once ('incl/fonctions/fonct_oubli.php');
		
		//tableau associatif qui contiendra les erreurs
		$erreur = [];
		
		//Si identifiant dans mon form. est vide alors 'il n'est pas fourni'
		if( empty( $login ) ) {
			$erreur['login'] = "Le mail n'est pas fourni";
		}elseif( !mail_exists() ) {
			$erreur['login'] = "Le mail n'existe pas";
		}
		
		//Si le tableau n'a pas d'erreurs, formulaire OK !
		if( !$erreur ) {
			$subject = "Récupération du mot de passe perdu";
			
			$mdp = password_recupeMail();
			
			$infos = getNomPrenomEmploye2();//par rapport au login ['login'] = login

			$message ="Bonjour $infos,\n

Vous avez demandé à récupérer votre mot de passe. Votre mdp est $mdp\n
à bientôt\n
L'équipe de la Maison des Ligues de Lorraine

";
			mail_html2($subject, $message);
			
			$validation = "Nous venons de vous envoyer un email contenant votre mot de passe. !";
			unset($login);
			header("Refresh:1 ; url=login.php");
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
		
		<title>PPE2- Maison des ligues</title>
		
	</head>
	<body>
		<style>
			#form h1 {
				margin-left: -100px;
				width: 250px;
			}
		</style>
		<div class="container-fluid">
			<div id="formConnexion2" class="row">	
				<div id="form2">
					<form id="form" class="form-horyzontal" role="form" action="oubli.php?oubli=2" method="POST">
						<h1>Récupération du mot de passe</h1>

						
						<?php if( isset($erreur['login']) ) :?>
							<div id="erreurEmail" class="btn btn-danger"><?= $erreur['login'] ?></div>
						<?php endif; ?><br/>

						<?php if( isset($validation) ) :?>
							<div id="erreurEmail" class="btn btn-success"><?= $validation ?></div>
						<?php endif; ?><br/>
						
						<br/><br/><br/><br/>
						
						<div class="input-group margin-bottom-sm">
							<!-- fa fa-envelope-o fa-fw -->
							<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
							<input class="form-control" type="text" id="text2" name="login" placeholder="Mail..." value="<?php if(isset( $login  ) ) :?><?= $login; ?><?php endif; ?>"/>
							<a class="btn btn-default" href="oubli?oubli=1.php">Récupération mdp par identifiant</a>
						</div>
						
						<br/><br/>
				
						<br/><br/><br/>
						
						<div id="wrapContent1" class="input-group margin-bottom-sm">
							<button type="submit" id="submit2" class="btn btn-primary form-control">M'envoyer mon mot de passe</button>
						</div>
						<div id="connexionBouton">
							<a href="login.php" class="btn btn-info" role="button">Retourner vers la page de connexion</a>
						</div>
				</div>		
					</form>
				</div>
			</div>
		</div>
		<script src="js/javascript.js"></script>
	</body>
</html>