<?php
	$data = rechercheHistoriqueFormations();
?>

<h1>Historique formation :</h1>
<br/><br/>
<!-- On affiche le contenu de $data -->
<!-- On affiche le contenu de $data -->
<div id="formationsList3">
	<?php foreach($data as $key => $formations) :?>
	
		<?php $idFormation = $formations['idFormation']; ?>
		
		<?php $data2 = rechercheFormationsEtats($idEmploye, $idFormation); ?>
		
		<?php foreach($data2 as $key => $formation_inscrite) : ?>
	
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
					<th>PDF</th>
					<?php if ($formation_inscrite['idFormation'] != NULL) { ?>
					<th>ETAT</th>
					<?php } if($formation_inscrite['etat'] != NULL && ($formation_inscrite['etat']== 'En cours' || $formation_inscrite['etat'] == 'Validée')) { ?>
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
					<td><a href="pdf.php?titre_formation=<?= $formations['titre_formation']; ?>&amp;contenu_formation=<?= $formations['contenu_formation']; ?>&amp;date_formation=<?= $formations['date_formation']; ?>&amp;duree_formation=<?= $formations['duree_formation']; ?>&amp;nbJours_formation=<?= $formations['nbJours_formation']; ?>&amp;lieu_formation=<?= $formations['lieu_formation']; ?>&amp;prerequis_formation=<?= $formations['prerequis_formation']; ?>&amp;credit_formation=<?= $formations['credit_formation']; ?>"><i><button class="btn btn-info">pdf</button></i></td>
					
					<?php if($formation_inscrite['etat'] != NULL) { ?>
					<td><?= $formation_inscrite['etat']; ?> </td>
					<?php }
					if($formation_inscrite['etat'] != NULL && ($formation_inscrite['etat']=='En cours' || $formation_inscrite['etat']=='Validée')) { ?>
					<td><a href="index.php?idFormation=<?= $formations['idFormation'] ;?>&formation=3&inscription=0"><i><button class="btn btn-primary">Désinscription</button></i></a></td>
					<?php } else { ?>
					<td><a href="index.php?idFormation=<?= $formations['idFormation'] ;?>&formation=3&inscription=1"><i><button class="btn btn-primary">inscription</button></i></a></td>
					<?php } ?>
				</tr>
			</tbody>
		</table>
		
		<?php endforeach; ?>
		
	<?php endforeach;?>
</div>