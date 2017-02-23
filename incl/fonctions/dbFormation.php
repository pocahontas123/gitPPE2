<?php	

	require('fonct_bd.php');
	
	//Recherche formations FUTURES pour lesquels l'utilisateur N'EST PAS INSCRIT
	function rechercheToutesFormation(int $idEmploye) : array{
		$data = bdd_select( 'SELECT * FROM formation WHERE date_formation >= NOW() AND idFormation NOT IN(SELECT selectionner.idFormation FROM selectionner INNER JOIN formation ON formation.idFormation = selectionner.idFormation WHERE selectionner.idEmploye = ?)', [$idEmploye] );
		return $data;
	}
	
	//Recherche formations FUTURES pour lesquelles l'employé EST INSCRIT
	function rechercheFormationsUtilisateur(int $idEmploye) : array{
		$data = bdd_select( 'SELECT formation.idFormation, titre_formation, date_formation, duree_formation, contenu_formation, nbJours_formation, lieu_formation, prerequis_formation, credit_formation, selectionner.etat, prestataire.nomPrestataire from prestataire, employe join selectionner on employe.idEmploye = selectionner.idEmploye join formation on formation.idFormation = selectionner.idFormation where employe.idEmploye = ?', [$idEmploye] );
		return $data;
	};
	
	//Recherche formations de l'ANNEE EN COURS pour lesquelles l'employé EST INSCRIT OU NON
	function rechercheHistoriqueFormations() : array{
		$data = bdd_select( 'SELECT * from formation WHERE YEAR(date_formation) = YEAR(now())' );
		return $data;
	};
	
	//Recherche le prix en jours et en crédits d'une formation
	function jourCreditFormation(int $idFormation) : array{
		$data = bdd_select( 'SELECT credit_formation, duree_formation FROM formation WHERE idFormation=?', [$idFormation] );
		return $data;
	};
	
	//Module 'Recherche'. Permet de connaître les formations FUTURES selon un critère de recherche '%$search%'
	function rechercheFormation(string $search) {
		$data = bdd_select( "SELECT * FROM formation WHERE titre_formation LIKE '%$search%' AND YEAR(date_formation) = YEAR(now()) ORDER BY idFormation");
		return $data;
	};
	
	//Affichage des formations de l'utilisateur + état
	function rechercheFormationsEtats(int $idEmploye, int $idFormation) : array{
		$data = bdd_select( "SELECT formation.idFormation, selectionner.etat  from formation INNER join selectionner on formation.idFormation = selectionner.idFormation INNER join employe on employe.idEmploye = selectionner.idEmploye WHERE employe.idEmploye= $idEmploye AND formation.idFormation=$idFormation");
		return $data;
	};
	

?>
