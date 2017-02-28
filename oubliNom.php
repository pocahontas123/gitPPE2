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
			$erreur['login'] = "L'identifiant n'est pas fourni";
		}elseif( !identifiant_exists() ) {
			$erreur['login'] = "L'identifiant n'existe pas";
		}
		
		//Si le tableau n'a pas d'erreurs, formulaire OK !
		if( !$erreur ) {
			$subject = "Récupération du mot de passe perdu";
			
			$mdp = password_recupe();
			
			$message ="Bonjour $login,\n

Vous avez demandé votre mot de passe. Votre mdp est $mdp\n
 bientôt
L'équipe de la Maison des Ligues de Lorraine

";
			mail_html($subject, $message);
			
			$validation = "Nous venons de vous envoyer un email contenant votre mot de passe. !";
			unset($login);
			header("Refresh:1 ; url=login.php");
		}
	}

?>
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
					<form id="form" class="form-horyzontal" role="form" action="oubli.php?oubli=1" method="POST">
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
							<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
							<input class="form-control" type="text" id="text2" name="login" placeholder="Identifiant..." value="<?php if(isset( $login  ) ) :?><?= $login; ?><?php endif; ?>"/>
							<a class="btn btn-default" href="oubli?oubli=2.php">Récupération mdp par email</a>
						</div>
						<br/><br/>
				</div>
						<br/><br/><br/>
						<div class="input-group margin-bottom-sm">
							<button type="submit" id="submit2" class="btn btn-primary form-control">M'envoyer mon mot de passe</button>
						</div>
						<div id="connexionBouton">
							<a href="login.php" class="btn btn-info" role="button">Retourner vers la page de connexion</a>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src="js/javascript.js"></script>
	</body>
</html>