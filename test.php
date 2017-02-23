<?php
if (!isset($_GET['inscription']) AND empty($_GET['inscription']))
{

if (isset($_GET['formation']) AND $_GET['formation']==1)
{
include("mesFormation.php");
}

elseif (isset($_GET['formation']) AND $_GET['formation']==2)
{
include("formationDisponible.php");
}

elseif (isset($_GET['formation']) AND $_GET['formation']==3)
{
include("historiqueFormation.php");
}

elseif (isset($_GET['formation']) AND $_GET['formation']==4)
{
include("search.php");
}
else
{
include("mesFormation.php");
}

}

elseif (isset($_GET['inscription']) AND $_GET['inscription']==1 AND isset($_GET['idFormation']))

{

// vérification de nbjour et crédit suffisant pour l'employé pour cette formation :
//Appel à la fonction JourCreditFormation($idFormation) du fichier dbFormation.php pour avoir le crédit et la duree de la formation

$joursCreditFormation = jourCreditFormation($idFormation);

 // appel de la fonction suffisanceJoursCreditUtilisateur($idEmploye) qui doit être créée dans le fichier dbUtilisateur.php . cette fonction va nous renvoyer un booléen vrai si jour crédit suffisant faux sinon

If (suffisanceJoursCreditUtilisateur($idEmploye))
{
// faire le point 10 du mail précédent
	ajoutSelection($idEmploye, $idFormation);
	soustractionJoursCreditUtilisateur($idEmploye, $idFormation);
if (isset($_GET['formation']) AND $_GET['formation']==1)
{
include("mesFormation.php");
}

elseif (isset($_GET['formation']) AND $_GET['formation']==2)
{
include("formationDisponible.php");
}

elseif (isset($_GET['formation']) AND $_GET['formation']==3)
{
include("historiqueFormation.php");
}

elseif (isset($_GET['formation']) AND $_GET['formation']==4)
{
include("search.php");
}
else
{
include("mesFormation.php");
}
}

else
{
// afficher un message d'erreur
	echo 'erreur';
if (isset($_GET['formation']) AND $_GET['formation']==1)
{
include("mesFormation.php");
}

elseif (isset($_GET['formation']) AND $_GET['formation']==2)
{
include("formationDisponible.php");
}

elseif (isset($_GET['formation']) AND $_GET['formation']==3)
{
include("historiqueFormation.php");
}

elseif (isset($_GET['formation']) AND $_GET['formation']==4)
{
include("search.php");
}
else
{
include("mesFormation.php");
}
}

}
elseif (isset($_GET['inscription']) AND $_GET['inscription']==0 AND isset($_GET['idFormation']))
{

// faire le point 9 du mail précédent
// message indiquant la bonne désincription
supprimerSelection($idEmploye, $idFormation);
ajoutJourCreditUtilisateur($idEmploye, $idFormation);
echo 'Désinscription ok';

if (isset($_GET['formation']) AND $_GET['formation']==1)
{
include("mesFormation.php");
}

elseif (isset($_GET['formation']) AND $_GET['formation']==2)
{
include("formationDisponible.php");
}

elseif (isset($_GET['formation']) AND $_GET['formation']==3)
{
include("historiqueFormation.php");
}

elseif (isset($_GET['formation']) AND $_GET['formation']==4)
{
include("search.php");
}
else
{
include("mesFormation.php");
}
}

}

?> 