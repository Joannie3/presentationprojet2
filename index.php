<?php
session_start();

include 'assets/includes/config.php';
include 'assets/includes/header.php';

$sqlafficheprojet = "SELECT * FROM projets p, utilisateurs u
WHERE p.id_utilisateurs=u.id_utilisateurs
ORDER BY p.id_projets DESC";
$requeteafficheprojet = $db->prepare($sqlafficheprojet);
$requeteafficheprojet->execute();
?>

<div class="container">


<div class="titreprojet">
    <div class="titreplacement">MES PROJETS</div> 
    <div class="titreplacement2">Vous pouvez consulter mes différents projets</div>

    <div class="fleche2">

    <div class="fleche"> > </div>

    </div>



</div>

<?php include 'assets/includes/navbar.php'; ?>

    <div class="listeprojet">

        <?php
        while ($afficheprojet = $requeteafficheprojet->fetch())
        {

            $dateposte = date("Y-m-d",strtotime($afficheprojet['datecreation_projets']));

        ?>
            <div class="cadreprojet">
                <div class="imageprojet">
                    <img src="assets/img/projets/<?php echo $afficheprojet["image_projets"];?>" alt="">
                        <div class="descriptionprojet">
                            <div class="lignedesriptionprojet">
                                <div class="gauchedescriptionprojet">Projet : </div>
                                <div class="droitedescriptionprojet"><?php echo $afficheprojet["nom_projets"];?></div>
                            </div>

                            <div class="lignedesriptionprojet">
                                <div class="gauchedescriptionprojet">Client : </div>
                                <div class="droitedescriptionprojet"><?php echo $afficheprojet["client_projets"];?></div>
                            </div>

                            <div class="lignedesriptionprojet">
                                <div class="gauchedescriptionprojet">Description : </div>
                                <div class="droitedescriptionprojet"><?php echo $afficheprojet["description_projets"];?></div>
                            </div>

                            <div class="lignedesriptionprojet">
                                <div class="gauchedescriptionprojet">Ajouté par : </div>
                                <div class="droitedescriptionprojet"><?php echo $afficheprojet["prenom_utilisateurs"];?></div>
                            </div>

                            <div class="lignedesriptionprojet">
                                <div class="gauchedescriptionprojet">Le : </div>
                                <div class="droitedescriptionprojet"><?php echo $dateposte;?></div>
                            </div>

                            <div class="lignedesriptionprojet">
                                <div class="gauchedescriptionprojetg"> <a href="<?php echo $afficheprojet["liensite_projets"];?>" target="_blank">Accèder au site</a> </div>
                                <div class="droitedescriptionprojetd"> <a href="<?php echo $afficheprojet["liengithub_projets"];?>" target="_blank">Accèder au GitHub</a></div>
                            </div>

                        </div>
                </div>
            </div>

        <?php
        }
        ?>
       
    </div>

    <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>

</div>

<script src="assets/js/nav.js"></script>

<?php

include 'assets/includes/footer.php';

?>
