<?php
require('fpdf.php');
require_once('assets/includes/config.php');


$sqlafficheprojet = "SELECT * FROM projets p, utilisateurs u
WHERE p.id_utilisateurs=u.id_utilisateurs
AND p.id_projets=:idprojet";
$requeteafficheprojet = $db->prepare($sqlafficheprojet);
$requeteafficheprojet->execute(array(
    ":idprojet" => $_GET['id']
));
$afficheprojet = $requeteafficheprojet->fetch();

class PDF extends FPDF
{
// En-tête
function Header()
{
// Police Arial gras 15
$this->SetFont('Arial','B',15);
// Décalage
$this->Cell(80);
// Titre encadré
$num = $_GET['id'];
$titre = utf8_decode("Résumé du projet n°".$num);
$this->Cell(20,10,$titre,0,0,'C');
// Saut de ligne
$this->Ln(20);
}

// Pied de page
function Footer()
{
// Positionnement à 1,5 cm du bas
$this->SetY(-15);
// Police Arial italique 10
$this->SetFont('Times','I',10);
// Numéro de page
// $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation du PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Bloc 1
$pdf->SetFont('Times','',12);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);

$nomprojet=$afficheprojet['nom_projets'];
$clientprojet=$afficheprojet['client_projets'];
$descriptionprojet=$afficheprojet['description_projets'];
$liensite=$afficheprojet['liensite_projets'];
$liengithub=$afficheprojet["liengithub_projets"];
$creerpar=$afficheprojet['prenom_utilisateurs'];
$ajoutele=date("d-m-Y",strtotime($afficheprojet['datecreation_projets']));
$image='assets/img/projets/'.$afficheprojet['image_projets'];

// $link = 'aaa';

// $pdf2->Write(100,'Accèder au GitHub',$link);

$pdf->Image($image,30,120,100); // premier chiffre X cm coté droit -- deuxieme chiffre Xcm en partant du haut
$txt1 = "
Nom du projet : $nomprojet
Client du projet : $clientprojet
Description du projet : $descriptionprojet
Lien site : $liensite
Lien GitHub : $liengithub
Créer par  : $creerpar
Ajouté le   : $ajoutele
Photo :
";
$txt1 = utf8_decode($txt1);
$pdf->Multicell(190,10,$txt1,0,'L', TRUE);

// Saut de lignes
$pdf->Ln(10);

// // Bloc 2
// $pdf->SetFont('Arial','',16);
// $pdf->SetFillColor(192,192,192);
// $pdf->SetTextColor(0,0,0);

// $txt2 = "Texte 2 en Arial 16 aligné à droite.";
// $txt2 = utf8_decode($txt2);
// $pdf->Multicell(190,10,$txt2,0,'R', TRUE);

// // Saut de lignes
// $pdf->Ln(10);

// // Bloc 3
// $pdf->SetFont('Times','',12);
// $pdf->SetFillColor(192,192,192);
// $pdf->SetTextColor(0,0,0);
// $txt3 = "Texte 3 en Times 12 centré bonjour.";
// $txt3 = utf8_decode($txt3);
// $pdf->Multicell(190,10,$txt3,0,'C', TRUE);

// Création du PDF
$fichier ="fichier3.pdf";
$pdf->Output($fichier,'D');

// Redirection vers le PDF
// header('location: fichier.pdf');
?> 