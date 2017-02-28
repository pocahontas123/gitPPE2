<?php

	if( !isset( $_SESSION['idEmploye'] ) AND !isset ( $_SESSION['mdp'] ) ) {
		header('Location: login.php');
	}
	
	$idEmploye = $_SESSION['idEmploye'];
	$data = rechercheFormationEmploye();
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
					<th>Nom et Prénom</th>
					<th>Valider</th>
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
					
					<td><?= $formations['etat']; ?> </td>
					<td><?= $formations['nomEmploye'].'-'.$formations['prenomEmploye']; ?> </td>
					
					<td><a href="index.php?idFormation=<?= $formations['idFormation'] ;?>&idEmploye=<?= $formations['idEmploye'] ;?>&nomEmploye=<?= $formations['nomEmploye'] ;?>&prenomEmploye=<?= $formations['prenomEmploye'] ;?>&titre_formation=<?= $formations['titre_formation'] ;?>&formation=5"><i><button class="btn btn-primary">Valider</button></i></a></td>
				</tr>
			</tbody>
		</table>
		
		<?php endforeach; ?>

</div>