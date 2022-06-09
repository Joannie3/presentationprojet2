<?php
session_start();

include 'assets/includes/header.php';
include 'assets/includes/navbar.php';

?>

<div class="container">
 

<div class="titre1">Ajouter un projet</div>

<div class="ajoutprojet">

<div class="affichemessageprojet"></div>

<form method="POST"  enctype="multipart/form-data" class="ajoutprojet1">

    <div class="ligne1">
        <div class="gaucheinscription">Nom du projet : </div>
        <div class="droiteinscription"> <input type="text" placeholder="Nom du projet" id="nomprojet" name="nomprojet"></div>
    </div>

    <div class="ligne1">
        <div class="gaucheinscription">Client : </div>
        <div class="droiteinscription"> <input type="text" placeholder="Client" id="clientprojet" name="clientprojet"></div>
    </div>

    <div class="ligne1">
        <div class="gaucheinscription">Description : </div>
        <div class="droiteinscription"> <input type="text" placeholder="Description du projet" id="descriptionprojet" name="descriptionprojet"></div>
    </div>

    <div class="ligne1">
        <div class="gaucheinscription">Lien du site : </div>
        <div class="droiteinscription"> <input type="url" placeholder="Adresse du site web" id="lienprojet" name="lienprojet"></div>
    </div>


    <div class="ligne1">
        <div class="gaucheinscription">Photo du projet : </div>
        <div class="droiteinscription"> <input type="file" name="photoprojet" id="photoprojet" accept="image/png, image/jpeg"></div>
    </div>


    

    <input type="submit" value="Ajouter le projet">

</form>

</div>



</div>

<script src="assets/js/ajoutprojet.js"></script>

<?php

include 'assets/includes/footer.php';

?>