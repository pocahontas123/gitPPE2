<div id="pagePrincipal" class="container-fluid">
	<div id="menu">
		 <nav class="navbar bg-primary">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <a class="navbar-brand" href="#">PPE 2|</a>
			</div>
			<ul class="nav navbar-nav navbar-right">
			
			<!-- Si je n'ai pas d''id' ou 'password' de SESSION, j'affiche connexion-->
			<?php if( !isset( $_SESSION['idEmploye'] ) AND !isset( $_SESSION['mdp'] ) ) :?>  	
			  <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
			<?php endif; ?>
			
			<!-- Sinon j'affiche déconnexion car je suis théoriquement connecté -->
			<?php if( isset( $_SESSION['idEmploye'] ) AND isset( $_SESSION['mdp'] ) ) :?>  	
			  		<div class="btn-group">
						<div class="container-fluid">
							<div class="row">
							
								<?php $data = getNomJoursCredit($idEmploye); ?>
								
								<button id="button_menu" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-bars fa-2x" aria-hidden="false"></i> Bienvenu <strong><?= $data[0]['login']; ?></strong><span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<br/>
									<li style="text-align: center; color: black;">Mes crédits: <strong><?= $data[0]['creditEmploye'] ;?></strong></li>
									<li role="separator" class="divider"></li>
									<li style="text-align: center; color: black;">Mes jours disponibles: <strong><?= $data[0]['nbJoursEmploye'] ;?></strong></li>
									<li role="separator" class="divider"></li>
									<li><a style="color: black;" href="deconnexion.php"><span class="glyphicon glyphicon-log-out"></span> Déconnexion</a></li>
								</ul>
							</div>	
						</div>
					</div>	
			<?php endif; ?>
			
			</ul>
		  </div>
		</nav>
	</div>
	<div id="menu2" class="container-fluid">
		<nav>
			<ol class="breadcrumb">
				<li><a href="index.php?formation=1">Mes formation(s)</a></li> 
				<li><a href="index.php?formation=2">Formation(s) disponible(s)</a></li>
				<li><a href="index.php?formation=3">Historique</a></li>
				
				<?php
				if( $typeEmploye == 3 ) {?>		
				<li><a href="index.php?formation=5">Formation(s) de mes employés</a></li>
				<?php };?>
			
			</ol>
		</nav>
	</div>	
	<div id="menuRecherche">
	<div class="row">
		<div class="col-lg-6">
			<form method="POST" action="index.php?formation=4">
				<div class="input-group">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit">Recherche: </button>
					</span>
					<input style="width: 100px" id="inputRecherche" name="search" type="text" class="form-control" placeholder="Trie des formations...">
				</div>
			</form>
		</div>
	</div>
</div>
