<?php
session_start();

require_once 'assets/includes/config.php';

$message = "";



    if (isset($_POST['nomprojet'], $_POST['clientprojet'], $_POST['descriptionprojet']) 
    && !empty($_POST['nomprojet']) && !empty($_POST['clientprojet']) && !empty($_POST['descriptionprojet']))
    {

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
            } 
            else 
            {
                // ici le type de fichier est correct
                // on limite à  1MO
                if ($filesizecv > 1024 * 1024) {
                    $message .= "<div class='negatif'>Le document est trop volumineux (1 Mo maximum)</div>";
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
                    } else {

                        // on interdit lexcution du fichier
                        chmod($newfilenamecv, 0644);

                        date_default_timezone_set('Europe/Paris');
                        $date = date('Y-m-d H:i:s');

                        $sqlajout = "INSERT INTO `projets` (`nom_projets`, `client_projets`,`description_projets`, `liensite_projets`, `image_projets`, `datecreation_projets`, `id_utilisateurs`) 
                        VALUES (:nom_projets, :clients_projets, :description_projets, :liensite_projets, :image_projets, :datecreation_projets, :id_utilisateurs)";
                        $requeteajout = $db->prepare($sqlajout);
                        $requeteajout->execute(
                            array(
                                ":nom_projets" =>$_POST['nomprojet'],
                                ":clients_projets" => $_POST['clientprojet'],
                                ":description_projets" => $_POST['descriptionprojet'],    
                                ":liensite_projets" => $_POST['lienprojet'],            
                                ":image_projets" => $docajoutcv,
                                ":datecreation_projets" => $date,
                                ":id_utilisateurs" => $_SESSION["membres"]["id"]
                        ));



                    
                        $message .=  "<div class='affirmatif'>Projet ajouté</div>";
                    }
                }
            }
        }
        

    }
    else
    {
        $message .= "Merci de remplir tous les champs";
    }

echo json_encode(array( 
    "message" => $message
));

?>