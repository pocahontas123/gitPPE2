<?php	

	require('fonct_bd.php');
	
	//Recherche formations FUTURES pour lesquels l'utilisateur N'EST PAS INSCRIT (pas idFormation dans la table selectionner)
	/*
		|formation.idFormation|titre|date|contenu|nbJours|lieu|prerequis|credit|prestataire.nomPrestataire|

		|prestataire.nomPrestataire|
		INNER JOIN prestataire ON formation.idPrestataire=prestataire.idPrestataire

		NOT IN()
		INNER JOIN formation ON formation.idFormation = selectionner.idFormation
	*/
	function rechercheToutesFormation(int $idEmploye) : array {
		$data = bdd_select( 'SELECT formation.idFormation, titre_formation, date_formation, contenu_formation, nbJours_formation, lieu_formation, prerequis_formation, credit_formation, prestataire.nomPrestataire
				FROM formation
				INNER JOIN prestataire ON formation.idPrestataire=prestataire.idPrestataire
				WHERE date_formation >= NOW() 
				AND formation.idFormation NOT IN (SELECT selectionner.idFormation FROM selectionner INNER JOIN formation ON formation.idFormation = selectionner.idFormation WHERE selectionner.idEmploye =  ?)', [$idEmploye] );
		
		return $data;
	};
	
	//Recherche formations FUTURES pour lesquelles l'employé EST INSCRIT
	function rechercheFormationsUtilisateur(int $idEmploye) : array {
		$data = bdd_select( 'SELECT formation.idFormation, titre_formation, date_formation, contenu_formation, nbJours_formation, lieu_formation, prerequis_formation, credit_formation, selectionner.etat,
				prestataire.nomPrestataire 
				FROM  employe 
				join selectionner on employe.idEmploye = selectionner.idEmploye
				join formation on formation.idFormation = selectionner.idFormation 
				INNER JOIN prestataire ON prestataire.idPrestataire=formation.idPrestataire  
				WHERE employe.idEmploye = ?', [$idEmploye] );
				
		return $data;
	};
	
	//Recherche formations de l'ANNEE EN COURS pour lesquelles l'employ� EST INSCRIT OU NON
	/*
		|idFormation|titre|date|contenu|nbJours|lieu|prerequis|credit|selectionner.etat|prestataire.nomPrestataire|

		|selectionner.etat|
		LEFT join selectionner on formation.idFormation = selectionner.idFormation


		|prestataire.nomPrestataire|
		INNER JOIN prestataire ON prestataire.idPrestataire=formation.idPrestataire 	
	*/
	function rechercheHistoriqueFormations() : array {
		$data = bdd_select( 'SELECT formation.idFormation, titre_formation, date_formation, contenu_formation, nbJours_formation, lieu_formation, prerequis_formation, credit_formation, selectionner.etat,
				prestataire.nomPrestataire FROM formation
				INNER JOIN prestataire ON prestataire.idPrestataire=formation.idPrestataire  
				LEFT join selectionner ON formation.idFormation = selectionner.idFormation
				WHERE YEAR(date_formation) = YEAR(now())' );
				
		return $data;
	};
	
	function rechercheFormationEmploye() : array {
		$data = bdd_select( 'SELECT titre_formation, formation.idFormation, selectionner.idEmploye, contenu_formation, date_formation, nbJours_formation, duree_formation, lieu_formation, prerequis_formation, credit_formation, prestataire.nomPrestataire, selectionner.etat, employe.nomEmploye, employe.prenomEmploye
				FROM formation
				INNER JOIN prestataire ON prestataire.idPrestataire=formation.idPrestataire
				INNER JOIN selectionner ON formation.idFormation = selectionner.idFormation
				INNER JOIN employe ON employe.idEmploye = selectionner.idEmploye
				WHERE YEAR(date_formation) = YEAR(now())
				AND selectionner.etat = "En cours"' );
		
		return $data;
	};
	
	
	//Recherche le prix en jours et en cr�dits d'une formation
	function jourCreditFormation(int $idFormation) : array {
		$data = bdd_select( 'SELECT credit_formation, nbJours_formation 
				FROM formation WHERE idFormation=?', [$idFormation] );
				
		return $data;
	};
	
	//Module 'Recherche'. Permet de conna�tre les formations FUTURES selon un crit�re de recherche '%$search%'
	function rechercheFormation(string $search) {
		$data = bdd_select( "SELECT formation.idFormation, titre_formation, date_formation, contenu_formation, nbJours_formation, lieu_formation, prerequis_formation, credit_formation, selectionner.etat,
				prestataire.nomPrestataire FROM  formation
				INNER JOIN prestataire ON prestataire.idPrestataire=formation.idPrestataire  
				LEFT join selectionner ON formation.idFormation = selectionner.idFormation
				WHERE titre_formation LIKE '%$search%' AND YEAR(date_formation) = YEAR(now()) ORDER BY idFormation" );
				
		return $data;
	};
	
	//Affichage des formations de l'utilisateur + état
	function rechercheFormationsEtats( int $idEmploye, int $idFormation ) : array {
		$data = bdd_select( "SELECT formation.idFormation, selectionner.etat 
				FROM formation 
				INNER join selectionner ON formation.idFormation = selectionner.idFormation 
				INNER join employe ON employe.idEmploye = selectionner.idEmploye 
				WHERE employe.idEmploye= $idEmploye AND formation.idFormation=$idFormation");
				
		return $data;
	};


	//Recherche un identifiant d'une formation
	//SELECT COUNT(*) = Pour connaître le nombre de lignes totales dans une table
	function rechercheIdFormation( int $idFormation ) : bool{
		$data = bdd_select( 'SELECT COUNT(*) AS nb_formation 
				FROM formation 
				WHERE idFormation = ? ', [$idFormation] );
				
		if( $data[0]['nb_formation'] == 0 ) {
			return false;
		} else {
			return true;
		}
	};
	
	//Affiche le nom de la formation par rapport à l' idFormation
	function rechercheNomFormation( int $idFormation ) : array {
		$data = bdd_select( 'SELECT titre_Formation 
				FROM formation 
				WHERE idFormation = ? ', [$idFormation] );
				
		return $data;
	};

?>
