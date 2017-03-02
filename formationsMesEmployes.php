<?php


	if( !isset( $_SESSION['idEmploye'] ) AND !isset ( $_SESSION['mdp'] ) ) {
		header('Location: login.php');
	}
	
	extract($_GET);
	$idEmploye = $_SESSION['idEmploye'];
	
	//Si je reçois  $idEmploye et que cette id existe et qu'il est bien assujetti à la $_SESSION du chef alors ok
	//Sinon affichage d'un message puis redirection
	if( isset( $_GET['idEmploye'] ) AND utilisateurExisteSuperieur( $_GET['idEmploye'], $_SESSION['idEmploye'] ) ) {
	
		$data = rechercheFormationEmploye2( $idEmploye, $_GET['idEmploye'] );
		?>
			<div> Les Formations de l'employé : <strong><?php echo $data[0]['nomEmploye'].' '.$data[0]['prenomEmploye'] ;?></strong> </div>
		<?php
		$data = rechercheFormationEmploye2( $idEmploye, $_GET['idEmploye'] );

?>

		<div id="formationsList">
		
			<?php foreach($data as $key => $formations) :?>

				<table class="table table-hover">
					<thead>
						<tr>
							<th>Titre</th>
							<th>Contenu</th>
							<th>Date</th>
							<th>Duree (Nb Jours)</th>
							<th>Lieu</th>
							<th>Prérequis</th>
							<th>Crédit(s)</th>
							<th>Prestataire</th>
							<th>PDF</th>
							<th>Etat</th>
							<th>Valider</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><strong><?= $formations['titre_formation']; ?></strong></td>
							<td><?= $formations['contenu_formation'] ;?></td>
							
							<?php $dateFormation = $formations['date_formation']; ?>
							<td><?= afficherDate( $dateFormation ); ?></td>
							
							<td><?= $formations['nbJours_formation']; ?></td>
							<td><?= $formations['lieu_formation']; ?></td>
							<td><?= $formations['prerequis_formation']; ?></td>
							<td><?= $formations['credit_formation']; ?></td>
							<td><?= $formations['nomPrestataire']; ?></td>
							
							<td><a href="pdf.php?idFormation=<?= $formations['idFormation'] ;?>"><i><button class="btn btn-info">pdf</button></i></td>
							
							<td><?= $formations['etat']; ?> </td>
							
							<td><a href="index.php?idFormation=<?= $formations['idFormation'] ;?>&idEmploye=<?= $formations['idEmploye'] ;?>&nomEmploye=<?= $formations['nomEmploye'] ;?>&prenomEmploye=<?= $formations['prenomEmploye'] ;?>&titre_formation=<?= $formations['titre_formation'] ;?>&formation=5"><i><button class="btn btn-primary">Valider</button></i></a></td>
						</tr>
					</tbody>
				</table>
		
		<?php endforeach; 
	}else {
		echo '<script>alert("L\'employe n\'existe pas ou alors vous n\'êtes pas son supérieur")</script>';
		//header("Refresh: 0; url=index.php?formation=5");
		//header( "Location: index.php?formation=5" );
		echo '<script>window.location.replace("index.php?formation=5")</script>';
	}
		?>

</div>