<?php
session_start();

require_once 'assets/includes/config.php';

$message = "";

$erreur = "";

    if (isset($_GET["action"]))
    {


        if($_GET["action"] == "editer")
        {

            // $message .= "bonjour<br>";
            // $message .= "id du form<br>";
            // $message .= $_POST['valeur'];

            // $message .= "projet<br>";
            // $message .= "nom projet <br>";
            // $message .= $_POST['nomprojet'];


            if (isset( $_POST['nomprojet'], $_POST['clientprojet'], $_POST['descriptionprojet'], $_POST['liensite'], $_POST['liengithub'], $_POST['datecreation']) 
            && !empty($_POST['nomprojet']) && !empty($_POST['clientprojet']) && !empty($_POST['descriptionprojet']) && !empty($_POST['liensite']) && !empty($_POST['liengithub']) && !empty($_POST['datecreation']))
            {

            $sqlaffichevrainom = "SELECT * FROM projets WHERE id_projets=:idproj";
            $requeteaffichevrainom = $db->prepare($sqlaffichevrainom);
            $requeteaffichevrainom->execute(array(
                ":idproj" => $_POST['valeur']
            ));
            $afficheaffichevrainom = $requeteaffichevrainom->fetch();

            // ici on verifie d'abord le nom du projet ici on autorise min maj espace - _ 
            $verifnom = preg_match ('@^[a-zA-Z0-9-_ ]+$@', $_POST['nomprojet']);

            //si c'est bon bon il affiche 0
            $affichenomprojet = $afficheaffichevrainom["nom_projets"];
            if (!$verifnom) {$erreur .= "<div class='negatif'>Nom du projet : N'utiliser que des lettres et des chiifres.</div>";}
            else {
                $sqlmaj = "UPDATE projets SET nom_projets=:nom_projets WHERE id_projets=:id";
                $requetemaj = $db->prepare($sqlmaj);
                $requetemaj->execute(array(
                    ":id" => $_POST['valeur'],
                    ":nom_projets" => $_POST['nomprojet']
                ));
                
                $affichenomprojet = $_POST['nomprojet'];
            }

            $verifclient = preg_match ('@^[a-zA-Z0-9-_ ]+$@', $_POST['clientprojet']);

            $afficheclientprojet = $afficheaffichevrainom["client_projets"];
            if (!$verifclient) {$erreur .= "<div class='negatif'>Nom du client : N'utiliser que des lettres et des chiifres.</div>";}
            else {
                $sqlmaj2 = "UPDATE projets SET client_projets=:client_projets WHERE id_projets=:id";
                $requetemaj2 = $db->prepare($sqlmaj2);
                $requetemaj2->execute(array(
                    ":id" => $_POST['valeur'],
                    ":client_projets" => $_POST['clientprojet']
                ));

                $afficheclientprojet = $_POST['clientprojet'];
            }

            $verifdescription = preg_match ('@^[a-zA-Z0-9-_ êéàèôîöïà]+$@', $_POST['descriptionprojet']);
            
            if (!$verifdescription) {$erreur .= "<div class='negatif'>Description : N'utiliser que des lettres et des chiifres.</div>";}
            else {
                $sqlmaj3 = "UPDATE projets SET description_projets=:description_projets WHERE id_projets=:id";
                $requetemaj3 = $db->prepare($sqlmaj3);
                $requetemaj3->execute(array(
                    ":id" => $_POST['valeur'],
                    ":description_projets" => $_POST['descriptionprojet']
                ));
            }

            $veriflienprojet = preg_match('/^(http|https):\/\/(www).([A-Z0-9][A-Z0-9_-]*(?:.[A-Z0-9][A-Z0-9_-]*)+):?(d+)?\/?/i', $_POST["liensite"]);

            $afficheliensite = $afficheaffichevrainom["client_projets"];
            if (!$veriflienprojet) {
                $erreur .= "<div class='negatif'>Merci de respecter la règle des adresses URL pour le lien projet (http://wwww.adresse.fr)</div>";
            } else {
                $sqlmaj4 = "UPDATE projets SET liensite_projets=:liensite_projets WHERE id_projets=:id";
                $requetemaj4 = $db->prepare($sqlmaj4);
                $requetemaj4->execute(array(
                    ":id" => $_POST['valeur'],
                    ":liensite_projets" => $_POST['liensite']
                ));
                $afficheliensite = $_POST['liensite'];
            }

            $verifliengithub = preg_match('/^(http|https):\/\/(www).([A-Z0-9][A-Z0-9_-]*(?:.[A-Z0-9][A-Z0-9_-]*)+):?(d+)?\/?/i', $_POST["liengithub"]);

            $afficheliengithub = $afficheaffichevrainom["liengithub_projets"];
            if (!$verifliengithub) {
                $erreur .= "<div class='negatif'>Merci de respecter la règle des adresses URL pour le lien projet (http://wwww.adresse.fr)</div>";
            } else {
                $sqlmaj5 = "UPDATE projets SET liengithub_projets=:liengithub_projets WHERE id_projets=:id";
                $requetemaj5 = $db->prepare($sqlmaj5);
                $requetemaj5->execute(array(
                    ":id" => $_POST['valeur'],
                    ":liengithub_projets" => $_POST['liengithub']
                ));
                $afficheliengithub = $_POST['liensite'];
            }

            $sqlmaj6 = "UPDATE projets SET datecreation_projets=:datecreation_projets WHERE id_projets=:id";
            $requetemaj6 = $db->prepare($sqlmaj6);
            $requetemaj6 ->execute(array(
                ":id" => $_POST['valeur'],
                ":datecreation_projets" => $_POST['datecreation']
            ));
            $affichedatecreation = date("Y-m-d",strtotime($_POST['datecreation']));
            $affichedatecreation2 = date("d-m-Y",strtotime($_POST['datecreation']));


            $sqlmaj7 = "UPDATE projets SET id_utilisateurs=:id_utilisateurs  WHERE id_projets=:id";
            $requetemaj7 = $db->prepare($sqlmaj7);
            $requetemaj7 ->execute(array(
                ":id" => $_POST['valeur'],
                ":id_utilisateurs" => $_POST['createur']
            ));

            $sqlcreateur3 = "SELECT * FROM utilisateurs WHERE id_utilisateurs=:iduti";
            $requetecreateur3 = $db->prepare($sqlcreateur3);
            $requetecreateur3->execute(array(
                "iduti" => $_POST['createur']
            ));
            $affichecreateur3 = $requetecreateur3->fetch();
            $affichecreateur4 = $affichecreateur3['prenom_utilisateurs'];

            $affichecreateur = '';
            $sqlcreateur = "SELECT * FROM utilisateurs";
            $requetecreateur = $db->prepare($sqlcreateur);
            $requetecreateur->execute();
            while ($affichecreateur2 = $requetecreateur->fetch())
            {
                if ($affichecreateur2["prenom_utilisateurs"] == $affichecreateur2['prenom_utilisateurs']){$disabled = 'selected';} else {$disabled = '';}

                $affichecreateur .= '<option value="'.$affichecreateur2["id_utilisateurs"].'" '.$disabled.'>'.$affichecreateur2["prenom_utilisateurs"].'</option>';
            }

            $afficheimage5 = '<input type="file" id="imageprojet'.$_POST['valeur'].'" name="imageprojet'.$_POST['valeur'].'">';
            $afficheimage6 = '<img src="assets/img/projets/'.$afficheaffichevrainom['image_projets'].'" alt="">'; 
            // ici on s'occupe de changer la photo
            if (isset($_FILES['imageprojet']) && $_FILES["imageprojet"]["error"] === 0)
            {

                // là on a recu l'image
                // on precoede aux verifications
                // on verifie tjr l'extension et e type Mime
                $allowedcv = [
                    "png" => "image/png",
                    "jpeg " => "image/jpeg",
                    "jpg" => "image/jpeg"
                    // "png" => "image/png" on liste les docs que l'on accepte
                ];

                $filenamecv = $_FILES["imageprojet"]["name"];
                $filetypecv = $_FILES["imageprojet"]["type"];
                $filesizecv = $_FILES["imageprojet"]["size"];


                $extensioncv = strtolower(pathinfo($filenamecv, PATHINFO_EXTENSION));

                // on verifie l'absence de l'extension dans les clés de $allowed ou l'absence du type mine dans les valeurs
                if (!array_key_exists($extensioncv, $allowedcv)) {
                    // ici soit l'extension soit le type est incorrect
                    $erreur .= "<div class='negatif'>Merci d'ajouter un fichier .png, .jpeg, .jpg uniquement</div>";
                    $valide .= "pasok";
                } 
                else 
                {
                    // ici le type de fichier est correct
                    // on limite à  1MO
                    if ($filesizecv > 1024 * 1024) {
                        $erreur .= "<div class='negatif'>Le document est trop volumineux (1 Mo maximum)</div>";
                        $valide .= "pasok";
                    } else {
                        // ici la taille est ok
                        // on génére un nom unique
                        $new_namecv = md5(uniqid());

                        $docajoutcv = $new_namecv . "." . $extensioncv;


                        // on génere le chemin complet
                        $newfilenamecv = "assets/img/projets/$new_namecv.$extensioncv";

                        // On deplace le fichier de tmp a upload en le renomant
                        if (!move_uploaded_file($_FILES["imageprojet"]["tmp_name"], $newfilenamecv)) {
                            $erreur .= "<div class='negatif'>Une erreur est survenue lors du téléchargement du document</div>";
                            $valide .= "pasok";
                        } else {

                            // on interdit lexcution du fichier
                            chmod($newfilenamecv, 0644);

                            $sqlimagebase = "SELECT * FROM projets
                            WHERE id_projets=:id";
                            $requeteimagebase = $db->prepare($sqlimagebase);
                            $requeteimagebase->execute(array(
                                ":id" => $_POST['valeur']
                            ));
                            $afficheimagebase = $requeteimagebase->fetch();

                            $doc = $afficheimagebase["image_projets"];

                            unlink ("assets/img/projets/$doc");

                            $sqlmaj8 = "UPDATE projets SET image_projets=:image_projets  WHERE id_projets=:id";
                            $requetemaj8 = $db->prepare($sqlmaj8);
                            $requetemaj8 ->execute(array(
                                ":id" => $_POST['valeur'],
                                ":image_projets" => $docajoutcv
                            ));

                            $afficheimage5 .= '
                            <input type="file" id="imageprojet'.$_POST['valeur'].'" name="imageprojet'.$_POST['valeur'].'">';

                            $afficheimage6 = '
                            <img src="assets/img/projets/'.$docajoutcv.'" alt="">
                            ';

                        }
                    }
                }
            }else {}

            $message = "<div class='affirmatif'>Projet mis à jour pour le projet N°".$_POST['valeur']."</div>";

            echo json_encode(array( 
                "id" => $_POST['valeur'],
                "message" => $message,
                "erreur" => $erreur,
                "affichenomprojet" => $affichenomprojet,
                "afficheclientprojet" => $afficheclientprojet,
                "afficheliensite" => $afficheliensite,
                "afficheliengithub" => $afficheliengithub,
                "affichedatecreation" => $affichedatecreation,
                "affichedatecreation2" => $affichedatecreation2,
                "affichecreateur" => $affichecreateur,
                "affichecreateur4" => $affichecreateur4,
                "afficheimage5" => $afficheimage5,
                "afficheimage6" => $afficheimage6
            ));
            
            }
            else {
                $message = "Merci de ne pas laisser de champ libre";
            }
        }


        $message = '';

        if($_GET["action"] == "suppr")
        {
            $sqlafficheprojet = "SELECT * FROM projets p, utilisateurs u
            WHERE p.id_utilisateurs=u.id_utilisateurs
            AND p.id_projets = :idprojet";
            $requeteafficheprojet = $db->prepare($sqlafficheprojet);
            $requeteafficheprojet->execute(array(
                "idprojet" => $_POST['valeur']
            ));
            $afficheprojet = $requeteafficheprojet->fetch();

            $message .= "<br>
            Nom du projet : ".$afficheprojet['nom_projets']."<br>  
            Description du projet : ".$afficheprojet['description_projets']."<br>  
            Ajouté par ".$afficheprojet['prenom_utilisateurs']."<br>  <br>  
           <div class='negatif'>Cette action est irréversible.</div> 
            ";

            $boutonsuppr = '
            <a href="crud.php?a=s&i='.$_POST['valeur'].'" class="btn_jo" role="button" data-dismiss="dialog">Je valide la suppression du projet</a>';

            echo json_encode(array( 
                "id" => $_POST['valeur'],
                "message" => $message,
                "boutonsuppr" => $boutonsuppr
            ));

        }

    }



?>