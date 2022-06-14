<?php
session_start();

if (!isset($_SESSION['membres']))
{  
        header("Location:index.php");
}
else {
include 'assets/includes/config.php';
include 'assets/includes/header.php';
?>

<div class="titreprojet">
    <div class="titreplacement">AJOUTER UN PROJET</div> 
    <div class="titreplacement2">Permet d'ajouter un projet que vous avez réalisé</div>

    <div class="fleche2">

    <div class="fleche"> > </div>

    </div>

</div>

<?php
include 'assets/includes/navbar.php';
?>

<div class="container">
 
    <div class="ajoutprojet">

        <div class="affichemessageprojet"></div>

        <form method="POST"  enctype="multipart/form-data" class="ajoutprojet1">

            <div class="ligneprojet">
                <div class="gaucheprojet">Nom du projet : </div>
                <div class="droiteprojet"> <input type="text" placeholder="Nom du projet" id="nomprojet" name="nomprojet"></div>
            </div>

            <div class="ligneprojet">
                <div class="gaucheprojet">Client : </div>
                <div class="droiteprojet"> <input type="text" placeholder="Client" id="clientprojet" name="clientprojet"></div>
            </div>

            <div class="ligneprojet">
                <div class="gaucheprojet">Description : </div>
                <div class="droiteprojet"> <textarea type="text" placeholder="Description du projet" id="descriptionprojet" name="descriptionprojet"></textarea></div>
            </div>

            <div class="ligneprojet">
                <div class="gaucheprojet">Lien du site : </div>
                <div class="droiteprojet"> <input type="text" placeholder="http://www.adresse.fr" id="lienprojet" name="lienprojet"></div>
            </div>

            <div class="ligneprojet">
                <div class="gaucheprojet">Lien du GitHub : </div>
                <div class="droiteprojet"> <input type="text"placeholder="http://www.adresse.fr" id="liengithub" name="liengithub"></div>
            </div>


            <div class="ligneprojet">
                <div class="gaucheprojet">Photo du projet : </div>
                <div class="droiteprojet"> <input type="file" name="photoprojet" id="photoprojet" accept="image/png, image/jpeg"></div>
            </div>


            <div class="ligneprojet">
            <input type="submit" value="Ajouter le projet" class="boutoninscription">
            </div>
            
        </form>

    </div>



</div>

<script src="assets/js/ajoutprojet.js"></script>

<?php

include 'assets/includes/footer.php';

}
?>