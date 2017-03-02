<?php

	if( !isset( $_SESSION['idEmploye'] ) AND !isset ( $_SESSION['mdp'] ) ) {
		header('Location: login.php');
	}
	
	$idEmploye = $_SESSION['idEmploye'];
	$data = rechercheFormationEmploye($idEmploye);
?>

<div id="formationsList">

	

		<table class="table table-hover">
			<thead>
				<tr>
					<th>Nom et Prénom</th>
					<th>Formations</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($data as $key => $formations) :?>
			
				<tr>
				   <td><?= $formations['nomEmploye'].' '.$formations['prenomEmploye']; ?> </td>
				   
				   <td><a href="index.php?idEmploye=<?= $formations['idEmploye'] ;?>&formation=6"><i><button class="btn btn-primary">Formations</button></i></a></td>
				</tr>
				
			<?php endforeach; ?>
			</tbody>
		</table>
		
		