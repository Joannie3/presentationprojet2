<?php
// ici on demarre la session PHP
session_start();

require_once 'assets/includes/config.php';


$message = "";

if (!empty($_POST)) {

    // il faut le mail et pass soit present tt les deux
    if (isset($_POST["mail"], $_POST["password"]) && !empty($_POST["mail"]) && !empty($_POST["password"])) 
    {

        $sql = "SELECT * FROM utilisateurs WHERE mail_utilisateurs=:mail";
        $query = $db->prepare($sql);
        $query->execute(array(
            ":mail" => $_POST["mail"]
        ));
        $membres = $query->fetch();

        if (!$membres) { 
                $message .= "<div class='negatif'>Désolé cette adresse e-mail n'existe pas</div>";                
        }
        else {
            // ici on continue si l'adresse mail existe
            if (!password_verify($_POST["password"], $membres["password_utilisateurs"])) {
                $message .= "<div class='negatif'>Désolé le mot de pass n'est pas valide.</div>";

            }
            else {

                $_SESSION["membres"] = [
                    "id" => $membres["id_utilisateurs"]
                ];                         

                $message .= "Vous êtes maintenant connecté, vous allez être redirigé";

            }
        }

    }
    else {
        echo "<div class='negatif'>Veuillez remplir tous les champs</div>";

    
    }

}

echo json_encode(array( 
    "message" => $message
));


?>

