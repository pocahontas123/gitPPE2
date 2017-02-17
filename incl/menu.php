<div id="pagePrincipal" class="container-fluid">
	<div id="menu">
		 <nav class="navbar bg-primary">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <a class="navbar-brand" href="#">PPE 2|</a>
			</div>
			<ul class="nav navbar-nav">
			  <li class="active"><a href="compte.php">Page principale</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			
			<!-- Si je n'ai pas d''id' ou 'password' de SESSION, j'affiche connexion-->
			<?php if( !isset( $_SESSION['idEmploye'] ) AND !isset( $_SESSION['mdp'] ) ) :?>  	
			  <li><a href="connexion.php"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
			<?php endif; ?>
			
			<!-- Sinon j'affiche déconnexion car je suis théoriquement connecté -->
			<?php if( isset( $_SESSION['idEmploye'] ) AND isset( $_SESSION['mdp'] ) ) :?>  	
			  <li><a href="deconnexion.php"><span class="glyphicon glyphicon-log-out"></span> Déconnexion</a></li>
			<?php endif; ?>
			
			</ul>
		  </div>
		</nav>
	</div>