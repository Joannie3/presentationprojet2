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
    <div class="titreplacement">Panel Administration</div>
    <div class="titreplacement2">Permet de gérer les publications, éditions, suppressions</div>

    <div class="fleche2">

        <div class="fleche"> > </div>

    </div>

</div>

<?php
include 'assets/includes/navbar.php';
?>

<div class="container">



    <div class="crud">
        <div class="messagecrud2">
            <?php
                if(isset($_GET['a']))
                {
                    if($_GET['a'] == "s"){

                        $sqlsupprprojet = "DELETE FROM projets WHERE id_projets =:idprojet";
                        $requetesupprprojet = $db->prepare($sqlsupprprojet);
                        $requetesupprprojet->execute(array(
                            ":idprojet" => $_GET['i']
                        ));
                        $affichesupprprojet = $requetesupprprojet->fetch();

                        echo "<div class='negatif'>Le projet n°".$_GET['i']." est bien supprimé</div>";
                    }
                }
            ?>
        </div>
    <div class="messagecrud"></div>

        <div class="titrecrud">
            <div class="sstitrecrud">Photo</div>
            <div class="sstitrecrud">Nom projet</div>
            <div class="sstitrecrud">Nom client</div>
            <div class="sstitrecrud">Date Création</div>
            <div class="sstitrecrud">Créer par</div>
        </div>

        <?php
    $sqlafficheprojet = "SELECT * FROM projets p, utilisateurs u
    WHERE p.id_utilisateurs=u.id_utilisateurs
    ORDER BY p.id_projets DESC";
    $requeteafficheprojet = $db->prepare($sqlafficheprojet);
    $requeteafficheprojet->execute();
    while ($afficheprojet = $requeteafficheprojet->fetch())
    {
    ?>
            <div class="titrecrud2" id="titrecrud2<?php echo $afficheprojet["id_projets"]; ?>" onClick="affiche(<?php echo $afficheprojet["id_projets"]; ?>)">

            <div class="sstitrecrud2 affichephoto<?php echo $afficheprojet["id_projets"];?> affichephoto">
                <img src="assets/img/projets/<?php echo $afficheprojet["image_projets"];  ?>" alt="">
            </div>

            <div class="sstitrecrud2 affichenomprojet<?php echo $afficheprojet["id_projets"];?> affichephoto">
                <?php echo $afficheprojet["nom_projets"];  ?>
            </div>
            <div class="sstitrecrud2 afficheclientprojet<?php echo $afficheprojet["id_projets"];?> affichephoto"><?php echo $afficheprojet["client_projets"]; ?></div>
            <div class="sstitrecrud2 affichedate<?php echo $afficheprojet["id_projets"];?> affichephoto"><?php echo date("d-m-Y",strtotime($afficheprojet['datecreation_projets'])); ?>
            </div>
            <div class="sstitrecrud2 affichecreateur<?php echo $afficheprojet["id_projets"];?> affichephoto"><?php echo $afficheprojet["prenom_utilisateurs"]; ?></div>
        </div>
        <div class="infocrud<?php echo $afficheprojet["id_projets"]; ?> infocrudcadre"
            id="infocrud<?php echo $afficheprojet["id_projets"]; ?>" style="display: none;">

            <form method="POST" class="modifprojetcrud" data-value="<?php echo $afficheprojet["id_projets"]; ?>">

            <div class="lignecrud">
                <div class="gauchecrud"> Nom du projet :</div>
                <div class="droitecrud"><input type="text" id="nomprojet<?php echo $afficheprojet["id_projets"]; ?>" name="nomprojet<?php echo $afficheprojet["id_projets"]; ?>" value="<?php echo $afficheprojet["nom_projets"];  ?>"></div>
            </div>

            <div class="lignecrud">
                <div class="gauchecrud"> Client :</div>
                <div class="droitecrud"><input type="text" id="clientprojet<?php echo $afficheprojet["id_projets"]; ?>" name="clientprojet<?php echo $afficheprojet["id_projets"]; ?>" value="<?php echo $afficheprojet["client_projets"];  ?>">
                </div>
            </div>

            <div class="lignecrud">
                <div class="gauchecrud"> Description du projet :</div>
                <div class="droitecrud"><textarea id="descriptionprojet<?php echo $afficheprojet["id_projets"]; ?>" name="descriptionprojet<?php echo $afficheprojet["id_projets"]; ?>"><?php echo $afficheprojet["description_projets"];?></textarea>
                </div>
            </div>

            <div class="lignecrud">
                <div class="gauchecrud"> Lien du site :</div>
                <div class="droitecrud liensite<?php echo $afficheprojet["id_projets"]; ?>">
                <input type="text" id="liensite<?php echo $afficheprojet["id_projets"]; ?>" name="liensite<?php echo $afficheprojet["id_projets"]; ?>" value="<?php echo $afficheprojet["liensite_projets"]; ?>">
                </div>
            </div>

            <div class="lignecrud">
                <div class="gauchecrud"> Lien GitHub  :</div>
                <div class="droitecrud liengithub<?php echo $afficheprojet["id_projets"]; ?>">
                <input type="text" id="liengithub<?php echo $afficheprojet["id_projets"]; ?>" name="liengithub<?php echo $afficheprojet["id_projets"]; ?>" value="<?php echo $afficheprojet["liengithub_projets"]; ?>">
                    </div>
            </div>

            <div class="lignecrud">
                <div class="gauchecrud"> Photo :</div>
                <div class="droitecrud imageprojet1<?php echo $afficheprojet["id_projets"];?>">
                <input type="file" id="imageprojet<?php echo $afficheprojet["id_projets"]; ?>" name="imageprojet<?php echo $afficheprojet["id_projets"]; ?>">
                </div>
            </div>

            <div class="lignecrud">
                <div class="gauchecrud"> Ajouté le  :</div>
                <div class="droitecrud"><input type="date" id="datecreation<?php echo $afficheprojet["id_projets"]; ?>" name="datecreation<?php echo $afficheprojet["id_projets"]; ?>" value="<?php echo date("Y-m-d",strtotime($afficheprojet['datecreation_projets'])); ?>">
                </div>
            </div>

            <div class="lignecrud">
                <div class="gauchecrud"> Créer par  :</div>
                <div class="droitecrud">
                    <select name="createur" id="createur<?php echo $afficheprojet["id_projets"]; ?>">
                        <?php
                            $sqlcreateur = "SELECT * FROM utilisateurs";
                            $requetecreateur = $db->prepare($sqlcreateur);
                            $requetecreateur->execute();
                            while ($affichecreateur = $requetecreateur->fetch())
                            {
                                if ($affichecreateur["prenom_utilisateurs"] == $afficheprojet['prenom_utilisateurs']){$disabled = 'selected';} else {$disabled = '';}

                                echo '<option value="'.$affichecreateur["id_utilisateurs"].'" '.$disabled.'>'.$affichecreateur["prenom_utilisateurs"].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="lignecrud">
                <div class="gauchecrud"></div>
                <div class="droitecrud"><input type="submit" value="Modifier"></div>
            </div>

            </form>

            <div class="lignecrud">
                <div class="gauchecrud"></div>
                <div class="droitecrud">
                            <a href="genpdf.php?id=<?= $afficheprojet["id_projets"]; ?>"> Télécharger le pdf</a>
                </div>
            </div>
            
            <div class="lignecrud">
            <div class="gauchecrud"> </div>
                <div class="droitecrud">
                    <a href="#" role="buttonmodal" data-target="#modalsuppresion" data-toggle="modal" 
                    data-value="<?php echo $afficheprojet['id_projets']; ?>" class="suppression">Suppression du projet</i></a>
                </div>
               
            </div>

        </div>
        <?php
    }
    ?>

<div class="modal_jo" id="modalsuppresion" role="dialog">
    <div class="modal-content_jo">
        <div class="modal-close_jo" data-dismiss="dialog">X</div>
        <div class="modal-header_jo">
            <p class="titremodal_jo">Suppression du projet</p>
        </div>
        <div class="modal-body_jo">

        <div class="infosuppression"></div>
        
        
        </div>

        <div class="modal-footer_jo">
            <a href="#" class="btn_jo btn-close_jo" role="button" data-dismiss="dialog">J'annule la suppression du projet</a>
            <div class="boutonsuppr"><a href="#" class="btn_jo " role="button" data-dismiss="dialog">Je valide la suppression du projet</a></div>

            <!-- <a href="#" class="btn_jo" role="button">Valider</a> -->
        </div>
    </div>
</div>

    </div>

</div>

<script src="assets/js/crud.js"></script>
<script src="assets/js/modal.js"></script>


<?php

include 'assets/includes/footer.php';

}
?>