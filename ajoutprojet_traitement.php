<?php
session_start();

require_once 'assets/includes/config.php';

$message = "";

$valide = "";

// $message .="nom projet : ";
// $message .=$_POST['nomprojet'];
// $message .="<br>";
// $message .="nom client : ";
// $message .=$_POST['clientprojet'];
// $message .="<br>";
// $message .="description  projet : ";
// $message .=$_POST['descriptionprojet'];
// $message .="<br>";

// $message .="lein  projet : ";
// $message .=$_POST['lienprojet'];
// $message .="<br>";



    if (isset($_POST['nomprojet'], $_POST['clientprojet'], $_POST['descriptionprojet']) 
    && !empty($_POST['nomprojet']) && !empty($_POST['clientprojet']) && !empty($_POST['descriptionprojet']))
    {

        // ici on verifie le nom + client + description + lien du site + lien github + photo (verif du dessous)
        if ($_POST["lienprojet"] == ""){$lienprojet = "Aucun"; $veriflienprojet = "1";}
        if ($_POST["lienprojet"] != ""){

            $veriflienprojet = preg_match('/^(http|https):\/\/(www).([A-Z0-9][A-Z0-9_-]*(?:.[A-Z0-9][A-Z0-9_-]*)+):?(d+)?\/?/i', $_POST["lienprojet"]);

            if (!$veriflienprojet) {
                $message .= "<div class='negatif'>Merci de respecter la règle des adresses URL pour le lien projet (http://wwww.adresse.fr)</div>";
                $valide .= "pasok";
            } else {
                $veriflienprojet = "1";
            }
            
            $lienprojet = $_POST["lienprojet"];
        }

        if ($_POST["liengithub"] == ""){$liengithub = "Aucun"; $verifliengithub = "1";}
        if ($_POST["liengithub"] != ""){

            $verifliengithub = preg_match('/^(http|https):\/\/(www).([A-Z0-9][A-Z0-9_-]*(?:.[A-Z0-9][A-Z0-9_-]*)+):?(d+)?\/?/i', $_POST["liengithub"]);
            
            if (!$verifliengithub) {
                $message .= "<div class='negatif'>Merci de respecter la règle des adresses URL pour le lien github (http://wwww.adresse.fr)</div>";
                    $valide .= "pasok";
            } else {
                $verifliengithub = "1";
            }
            
            $liengithub = $_POST["liengithub"];
        }

        if (($veriflienprojet) AND ($verifliengithub))
        {      
        
        // $message .="lein  projet : ";
        // $message .=$lienprojet;
        // $message .="<br>";
        
            if (isset($_FILES['photoprojet']) && $_FILES["photoprojet"]["error"] === 0)
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

                $filenamecv = $_FILES["photoprojet"]["name"];
                $filetypecv = $_FILES["photoprojet"]["type"];
                $filesizecv = $_FILES["photoprojet"]["size"];


                $extensioncv = strtolower(pathinfo($filenamecv, PATHINFO_EXTENSION));

                // on verifie l'absence de l'extension dans les clés de $allowed ou l'absence du type mine dans les valeurs
                if (!array_key_exists($extensioncv, $allowedcv)) {
                    // ici soit l'extension soit le type est incorrect
                    $message .= "<div class='negatif'>Merci d'ajouter un fichier .png, .jpeg, .jpg uniquement</div>";
                    $valide .= "pasok";
                } 
                else 
                {
                    // ici le type de fichier est correct
                    // on limite à  1MO
                    if ($filesizecv > 1024 * 1024) {
                        $message .= "<div class='negatif'>Le document est trop volumineux (1 Mo maximum)</div>";
                        $valide .= "pasok";
                    } else {
                        // ici la taille est ok
                        // on génére un nom unique
                        $new_namecv = md5(uniqid());

                        $docajoutcv = $new_namecv . "." . $extensioncv;


                        // on génere le chemin complet
                        $newfilenamecv = "assets/img/projets/$new_namecv.$extensioncv";

                        // On deplace le fichier de tmp a upload en le renomant
                        if (!move_uploaded_file($_FILES["photoprojet"]["tmp_name"], $newfilenamecv)) {
                            $message .= "<div class='negatif'>Une erreur est survenue lors du téléchargement du document</div>";
                            $valide .= "pasok";
                        } else {

                            // on interdit lexcution du fichier
                            chmod($newfilenamecv, 0644);

                            date_default_timezone_set('Europe/Paris');
                            $date = date('Y-m-d H:i:s');

                        
                            $sqlajout = "INSERT INTO `projets` (`nom_projets`, `client_projets`,`description_projets`, `liensite_projets`, `liengithub_projets`, `image_projets`, `datecreation_projets`, `id_utilisateurs`) 
                            VALUES (:nom_projets, :client_projets, :description_projets, :liensite_projets, :liengithub_projets, :image_projets, :datecreation_projets, :id_utilisateurs)";
                            $requeteajout = $db->prepare($sqlajout);
                            $requeteajout->execute(
                                array(
                                    ":nom_projets" =>$_POST['nomprojet'],
                                    ":client_projets" => $_POST['clientprojet'],
                                    ":description_projets" => $_POST['descriptionprojet'],    
                                    ":liensite_projets" => $lienprojet,   
                                    ":liengithub_projets" => $liengithub,   
                                    ":image_projets" => $docajoutcv,
                                    ":datecreation_projets" => $date,
                                    ":id_utilisateurs" => $_SESSION["membres"]["id"]
                            ));

                            $valide .= "ok";

                        
                            $message .=  "<div class='affirmatif'>Projet ajouté</div>";
                        }
                    }
                }
            }
        }
        

    }
    else
    {
        $message .= "<div class='negatif'>Merci de remplir tous les champs</div>";
    }

echo json_encode(array( 
    "message" => $message,
    "valide" => $valide
));

?>