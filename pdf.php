<?php
	require_once "html2pdf/html2pdf.class.php";
	extract($_GET);
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
		<h2 style="text-align: center; text-decoration: underline;">Formation <?= $titre_formation; ?>:</h2>
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
				<td><?= $titre_formation; ?></td>
				<td><?= $contenu_formation; ?></td>
				<td style="width: 100px;"><?= $date_formation; ?></td>
				<td style="width: 100px;"><?= $nbJours_formation; ?></td>
				<td style="width: 100px;"><?= $lieu_formation; ?></td>
				<td style="width: 100px;"><?= $prerequis_formation; ?></td>
				<td style="width: 100px;"><?= $credit_formation; ?></td>
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
		$pdf->pdf->SetKeywords('HTML2PDF, '.$titre_formation.', PHP');
		$pdf->writeHTML($content);

		$pdf->Output($titre_formation.'.pdf',' D');
	} catch (HTML2PDF_exception $e) {
		die($e);
	}
?>