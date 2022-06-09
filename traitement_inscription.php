 <?php

require_once 'assets/includes/config.php';

$message = "";

$valide = "";

if (isset($_POST['mail'], $_POST['nom'], $_POST['prenom'], $_POST['password']) && !empty($_POST['mail']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['password']))
{

    date_default_timezone_set('Europe/Paris');
    $date = date('Y-m-d H:i:s');

    if (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL))
    {
        $message .= "<div class='negatif'>Merci de rentrer un e-mail correct</div>";
        $valide .="pasok";
    }
    else
    {

        // ici on verifie que l'adresse mail n'existe pas
        $sqlcomptes = "SELECT * FROM utilisateurs WHERE mail_utilisateurs=:mail";
        $requetecomptes = $db->prepare($sqlcomptes);
        $requetecomptes->execute(array(
            ":mail" =>$_POST['mail']
        ));
        $affichecomptes = $requetecomptes->fetch();
        $affichecomptes1 = $requetecomptes->rowCount();


        if ($affichecomptes1 >= 1 )
        {
            $message .= "<div class='negatif'>L'adresse mail existe déjà, merci d'utiliser une autre adresse mail</div>";
            $valide .="pasok";
        }
        else 
        {

            //ici on verifie que le pseudo et le nom ne possede que des lettres
            $nomlettre = preg_match_all("#^\D+$#", $_POST['nom']);
            $prenomlettre = preg_match_all("#^\D+$#", $_POST['prenom']);

            if ((!$nomlettre) or (!$prenomlettre))
            {
                $message .= "<div class='negatif'>Merci de ne pas mettre de chiffre dans votre nom et/ou prénom</div>";
                $valide .="pasok";
            }
            else {           

                $pass = password_hash($_POST["password"], PASSWORD_ARGON2ID);

                $sqlajout = "INSERT INTO `utilisateurs` (`mail_utilisateurs`, `nom_utilisateurs`,`prenom_utilisateurs`, `password_utilisateurs`, `inscription_utilisateurs`) 
                VALUES (:mail_utilisateurs, :nom_utilisateurs, :prenom_utilisateurs, :password_utilisateurs, :inscription_utilisateurs)";
                $requeteajout = $db->prepare($sqlajout);
                $requeteajout->execute(
                    array(
                        ":mail_utilisateurs" =>$_POST['mail'],
                        ":nom_utilisateurs" => $_POST['nom'],
                        ":prenom_utilisateurs" => $_POST['prenom'],            
                        ":password_utilisateurs" => $pass,
                        ":inscription_utilisateurs" => $date
                ));

                $message .= "<div class='affirmatif'>Votre inscription est prise en compte vous pouvez vous connecter</div>";
                $valide .="ok";
            }
        }
    }   
}
else {
    $message .= "<div class='negatif'>Merci de remplir tous les champs</div>";
}


echo json_encode(array( 
    "message" => $message,
    "valide" => $valide
));

?>