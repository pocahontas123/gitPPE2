<?php

	//session_start();
	if( !isset( $_SESSION['idEmploye'] ) AND !isset ( $_SESSION['mdp'] ) ) {
		header('Location: login.php');
	}

	$idEmploye = $_SESSION['idEmploye'];
	$data = rechercheToutesFormation($idEmploye);
	
?>

<br/><br/>

<!-- On affiche le contenu de $data -->
<div id="formationsList2">

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
					<th>Inscription</th>
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
					
					<!--Lien des infos de la formation vers pdf.php-->
					<td><a href="pdf.php?idFormation=<?= $formations['idFormation'] ;?>"><i><button class="btn btn-info">pdf</button></i></td>
					
					<td><a href="index.php?idFormation=<?= $formations['idFormation'] ;?>&formation=2&inscription=1"><i><button class="btn btn-primary">Inscription</button></i></a></td>
				</tr>
			</tbody>
		</table>
		
	<?php endforeach; ?>
		
</div>