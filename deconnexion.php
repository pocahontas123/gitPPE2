<?php
	/*R�sum� de la page:
	1)  Je vide ma SESSION
	2)  Je tue mes cookies
	3)  Je d�truit ma SESSION
	4) Je me redirige vers ma page de 'connexion.php'

	*/
	session_start();//obligatoire, je demarre ma session
	$_SESSION = [];// Je vide mes donn�es de session
	
	//Je delet les cookies (m�me si actuellement, il n'y en a pas)
	if ( ini_get("session.use_cookies") ) {
		$params = session_get_cookie_params();
		setcookie( session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}
	session_destroy();//d�truit la session
	
	//je redirige l'utilisateur sur la page pour se connecter
	header( 'Location: index.php' );
?>