<?php
include 'assets/includes/header.php';
?>

<div class="titreprojet">
    <div class="titreplacement">CONNEXION</div> 
    <!-- <div class="titreplacement2"></div> -->

    <div class="fleche2">

    <div class="fleche"> > </div>

    </div>

</div>

<?php
include 'assets/includes/navbar.php';
?>

<div class="container">
 

    <div class="inscription">

        <div class="affichemessageinscription"></div>

        <form method="POST" action="traitement_connexion.php" class="verifconnexion">

            <div class="ligne1">
                <div class="gaucheinscription">E-mail : </div>
                <div class="droiteinscription"> <input type="mail" placeholder="Votre adresse mail" id="mail" name="mail"></div>
            </div>

            <div class="ligne1">
                <div class="gaucheinscription">Password : </div>
                <div class="droiteinscription"> <input type="password" id="password" name="password"></div>
            </div>

            <div class="ligne1">
                <input type="submit" value="Connexion" class="boutoninscription">
            </div>
        </form>



    </div>

</div>

<script src="assets/js/connexion.js"></script>

<?php

include 'assets/includes/footer.php';

?>