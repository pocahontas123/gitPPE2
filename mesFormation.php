<?php

	if( !isset( $_SESSION['idEmploye'] ) AND !isset ( $_SESSION['mdp'] ) ) {
		header('Location: login.php');
	}
	
	$idEmploye = $_SESSION['idEmploye'];
	$data = rechercheFormationsUtilisateur($idEmploye);
	
?>
	

<!-- On affiche le contenu de $data -->
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
					<?php if ($formations['idFormation'] != NULL) { ?>
					<th>ETAT</th>
					<?php } if($formations['etat'] != NULL && ($formations['etat']== 'En cours' || $formations['etat'] == 'Validée')) { ?>
					<th>Inscription</th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><strong><?= $formations['titre_formation']; ?></strong></td>
					<td><?= $formations['contenu_formation'] ;?></td>
					
					<?php $dateFormation = $formations['date_formation']; ?>
					<td><?= afficherDate($dateFormation); ?></td>
					
					<td><?= $formations['nbJours_formation']; ?></td>
					<td><?= $formations['lieu_formation']; ?></td>
					<td><?= $formations['prerequis_formation']; ?></td>
					<td><?= $formations['credit_formation']; ?></td>
                    <td><?= $formations['nomPrestataire']; ?></td>

					<td><a href="pdf.php?idFormation=<?= $formations['idFormation'] ;?>"><i><button class="btn btn-info">pdf</button></i></td>
					
					<?php if($formations['etat'] != NULL) { ?>
					<td><?= $formations['etat']; ?> </td>
					<?php }
						// affichage bouton désinscription
						if($formations['etat'] != NULL && ($formations['etat']=='En cours' || $formations['etat']=='Validée')) { ?>
						<td><a href="index.php?idFormation=<?= $formations['idFormation'] ;?>&formation=1&inscription=0"><i><button class="btn btn-primary">Désinscription</button></i></a></td>
					<?php } elseif ($formations['etat'] != NULL && ($formations['etat']=='Effectué'))  { ?>
						<!-- affiche rien -->
					<?php } ?>
				</tr>
			</tbody>
		</table>
		
		<?php endforeach; ?>

</div>