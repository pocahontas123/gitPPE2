<?php
	//Je lance ma session
	session_start();
	
	/*Si j'ai déjà mes superglobale de SESSION['id'] et 'password', je n'ai rien à faire sur connexion.php
	  vu que je suis "théoriquement" déjà connecté
	*/
	if( isset( $_SESSION['idEmploye'] ) AND isset( $_SESSION['mdp'] ) )  {
		header("Location: compte.php");
	}
	//Si mon formulaire n'est pas vide
	if( !empty( $_POST ) ) {
		//Je récupère mes données automatiquement sous la forme des name du formulaire en $identifiant et $password
		extract( $_POST );
		//Je relie mon fichier qui contient toutes mes fonction (account_exist et ident_libre)
		require_once ('incl/functions.php');	
		//Pour l'instant, remplit un tableau avec un ID et password
		$membre = account_exists();	
		//permet d'enregistrer les erreurs dans un tableau associatif
		$erreur = [];
		/*Si mon tableau est plein (ce qui est le cas car remplit manuellement)
		  je rempli mes variables de session.
		  Maintenant je suis "théoriquement" connecté
		*/
		if( $membre ) {
			$_SESSION['idEmploye'] = $membre['idEmploye'];
			$_SESSION['mdp'] = $membre['mdp'];
			$_SESSION['nom'] = $membre['nom'];
			//On me redirige sur 'compte.php' car je n'ai rien à faire dans connexion si je suis déjà connecté
			header("Location: compte.php");
		}else {
			//retourne rien donc mauvaises infos
			$erreur['membre'] = 'Les informations de connexion sont erronées';
		}
		
		
		
		//Gestion erreur identifiant vide
		if( empty( $nom ) ) {
			$erreur['nom'] = "L'identifiant n'est pas fourni";
		
		//Si l'identifiant est disponible alors il n'existe pas
		}
		//Gestion du mdp fourni ou du nombre de caractères (min. 10)
		if( empty( $mdp ) ) {
			$erreur['mdp'] = "Le password n'est pas fourni";
		}elseif( strlen( $mdp ) < 8 ) {
			$erreur['mdp'] = "Votre mot de passe doit faire 10 caractères";
		}
		//Si le tableau n'a pas d'erreur, on affiche que tout est ok
		if( !$erreur ) {
			$validation = "Formulaire OK";
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
			<div id="formConnexion" class="row">	
				<div id="form1">
					<form id="form" class="form-horyzontal" role="form" action="connexion.php" method="POST">
						<h1>Connexion</h1>
						
						<!--  -->
						<?php if( isset($erreur['nom']) ) :?>
							<div id="erreurEmail" class="btn btn-danger"><?= $erreur['nom'] ?></div>
						<?php endif; ?><br/>
						
						<!--  -->
						<?php if( isset($erreur['mdp']) ) :?>
							<div id="erreurEmail" class="btn btn-danger"><?= $erreur['mdp'] ?></div>
						<?php endif; ?><br/>
						
						<?php if( isset($erreur['membre']) ) :?>
							<div id="erreurEmail" class="btn btn-danger"><?= $erreur['membre'] ?></div>
						<?php endif; ?><br/>
						
						<?php if( isset($erreur['validation']) ) :?>
							<div id="erreurEmail" class="btn btn-danger"><?= $erreur['validation'] ?></div>
						<?php endif; ?><br/>
							
						<br/><br/>
						<div class="input-group margin-bottom-sm">
						  <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
						  <input class="form-control" type="text" id="nom" name="nom" placeholder="Identifiant..." value="<?php if(isset( $nom ) ) :?><?= $nom; ?><?php endif; ?>"/>
						</div>
						<br/><br/>
						<div class="input-group margin-bottom-sm">
						  <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
						  <input class="form-control" type="password" id="mdp" name="mdp" placeholder="Mot de passe...">
						</div>
						<br/><br/><br/>
						<div class="input-group margin-bottom-sm">
						  <button type="submit" id="submit1" class="btn btn-primary form-control">Envoyez</button>
						</div>	
						<a href="oubli.php">Mot de passe oublié</a>		
					</form>	
				</div>
			</div>
		</div>
		<script src="js/javascript.js"></script>
	</body>
</html>