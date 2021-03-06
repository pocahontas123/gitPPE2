<?php

	session_start();
	
	if( !isset( $_SESSION['idEmploye'] ) AND !isset ( $_SESSION['mdp'] ) ) {
		header('Location: login.php');
	}
	
	//class HTML2PDF qui permet de créer un .pdf à partir d'HTML, CSS et PHP
	require_once "html2pdf/html2pdf.class.php";
	require 'incl/fonctions/dbFormation.php';
	
	
	extract($_GET);
	if( isset($_GET['idFormation']) AND rechercheNomFormation( $_GET['idFormation'] ) ) {
		
		$data = rechercheInfoFormationEtPrestataire( $_GET['idFormation'] );	
		
		ob_start();
		
?>
		<page backtop="10mm" backleft="10mm" backright="10mm" backbottom="10mm" footer="page;">
			<page_footer>
				<hr />
				<p>Fait le <?php echo date("d/m/y"); ?></p>
			</page_footer>
			
			<style type="text/css">
				table { 
					color: #717375; 
					font-family: helvetica; 
					line-height: 5mm; 
					border-collapse: collapse; 
				}
			 
				.border th { 
					border: 1px solid #000;  
					color: white; 
					background: #000; 
					font-weight: normal; 
					font-size: 14px; 
					text-align: center; 
					}
				.border td { 
					border: 1px solid #CFD1D2; 
					text-align: center; 
					width: 190px;
				}
			</style>
			
			<?php foreach($data as $key => $formations) :?>
			
				<h2 style="text-align: center; text-decoration: underline;">Formation <?= $formations['titre_formation']; ?>:</h2>
				<table class="border">
					<tr>
						<th>Titre</th>
						<th>Contenu</th>
						<th>Date</th>
						<th>Duree(Nb Jours)</th>
						<th>Lieu</th>
						<th>Prerequis</th>
						<th>Credits</th>
					</tr>		
					<tr>
						<td><?= $formations['titre_formation']; ?></td>
						<td><?= $formations['contenu_formation']; ?></td>
						<td style="width: 100px;"><?= $formations['date_formation']; ?></td>
						<td style="width: 100px;"><?= $formations['nbJours_formation']; ?></td>
						<td style="width: 100px;"><?= $formations['lieu_formation']; ?></td>
						<td style="width: 100px;"><?= $formations['prerequis_formation']; ?></td>
						<td style="width: 100px;"><?= $formations['credit_formation']; ?></td>
					</tr>
				</table>
			</page>
<?php
			try {
				$content = ob_get_clean();
				$pdf = new HTML2PDF("L","A4","fr");
				$pdf->pdf->SetAuthor('GUILLOU Fabien');
				$pdf->pdf->SetTitle('formation');
				$pdf->pdf->SetSubject('Afficher formation');
				$pdf->pdf->SetKeywords('HTML2PDF, '.$formations['titre_formation'].', PHP');
				$pdf->writeHTML($content);
				
				//évite une erreur
				ob_end_clean();
				
				$pdf->Output($formations['titre_formation'].'.pdf',' D');
			} catch (HTML2PDF_exception $e) {
				die($e);
			}
		endforeach; 
	}else {
		echo '<script>alert("La formation est inconnue")</script>';
		//header("Refresh: 0; url=index.php?formation=1");
		//header( "Location: index.php?formation=1" );
		echo '<script>window.location.replace("index.php?formation=1")</script>';
		
	}
?>