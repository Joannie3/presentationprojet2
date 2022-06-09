<?php
session_start();

include 'assets/includes/config.php';
include 'assets/includes/header.php';
include 'assets/includes/navbar.php';

$sqlprojets = "SELECT * FROM projets p, utilisateurs u
WHERE p.id_utilisateurs=u.id_utilisateurs";
$requeteprojets = $db->prepare($sqlprojets);
$requeteprojets->execute();



?>

<div class="container">


<div class="titreprojet">Mes projets</div>

    <div class="listeprojet">

    
    
        <?php
        while ($afficheprojets = $requeteprojets->fetch())
        {

            $datecreation = date("d/m/Y",strtotime($afficheprojets['datecreation_projets']));

        ?>

        <div class="cadreprojet">
            <div class="imageprojet">
                <img src="assets/img/projets/<?php echo $afficheprojets["image_projets"]; ?>" alt="">
                    <div class="descriptionprojet">
                        <div class="lignedesriptionprojet">
                            <div class="gauchedescriptionprojet">Projet : </div>
                            <div class="droitedescriptionprojet"> <?php echo $afficheprojets["nom_projets"]; ?></div>
                        </div>

                        <div class="lignedesriptionprojet">
                            <div class="gauchedescriptionprojet">Client : </div>
                            <div class="droitedescriptionprojet"> <?php echo $afficheprojets["client_projets"]; ?></div>
                        </div>

                        <div class="lignedesriptionprojet">
                            <div class="gauchedescriptionprojet">Description : </div>
                            <div class="droitedescriptionprojet"> <?php echo $afficheprojets["description_projets"]; ?></div>
                        </div>

                        <div class="lignedesriptionprojet">
                            <div class="gauchedescriptionprojet">Ajouté par : </div>
                            <div class="droitedescriptionprojet"> <?php echo $afficheprojets["prenom_utilisateurs"]; ?></div>
                        </div>

                        <div class="lignedesriptionprojet">
                            <div class="gauchedescriptionprojet">Le : </div>
                            <div class="droitedescriptionprojet"> <?php echo $datecreation; ?></div>
                        </div>
                    </div>
            </div>

        </div>

        <?php
        }
        ?>

    </div>

</div>


<?php

include 'assets/includes/footer.php';

?>
