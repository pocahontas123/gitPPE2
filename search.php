<?php
//session_start();
if( !isset( $_SESSION['idEmploye'] ) AND !isset ( $_SESSION['mdp'] ) ) {
    header('Location: login.php');
}
	extract($_POST);
	$data = rechercheFormation($search);
?>
<h1>Recherche de formations :</h1>
<!-- On affiche le contenu de $data -->
<div id="formationsList4">
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
					<?php if ($formations['etat'] != NULL) { ?>
					<th>ETAT</th>
                    <?php } if($formations['etat']!= 'Effectuée' ) { ?>
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
					<td><a href="pdf.php?titre_formation=<?= $formations['titre_formation']; ?>&amp;contenu_formation=<?= $formations['contenu_formation']; ?>&amp;date_formation=<?= $formations['date_formation']; ?>&amp;nbJours_formation=<?= $formations['nbJours_formation']; ?>&amp;lieu_formation=<?= $formations['lieu_formation']; ?>&amp;prerequis_formation=<?= $formations['prerequis_formation']; ?>&amp;credit_formation=<?= $formations['credit_formation']; ?>"><i><button class="btn btn-info">pdf</button></i></td>
					
					<?php if($formations['etat'] != NULL) { ?>
					<td><?= $formations['etat']; ?> </td>
					<?php }
					if($formations['etat'] != NULL && ($formations['etat']=='En cours' || $formations['etat']=='Validée')) { ?>
					<td><a href="index.php?idFormation=<?= $formations['idFormation'] ;?>&formation=1&inscription=0"><i><button class="btn btn-primary">Désinscription</button></i></a></td>
                    <?php }
                    elseif ($formations['etat'] != NULL && ($formations['etat']=='Effectuée'))
                    {}

                    else  { ?>
                        <td><a href="index.php?idFormation=<?= $formations['idFormation'] ;?>&formation=1&inscription=1"><i><button class="btn btn-primary">inscription</button></i></a></td>
                    <?php } ?>
				</tr>
			</tbody>
		</table>
		
		<?php endforeach; ?>
		
</div>
