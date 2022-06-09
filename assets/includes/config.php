<?php

// ici on defini des constantes d'environnement
define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DBNAME", "presentationprojets");


// DSN de connexion
$dsn = "mysql:dbname=".DBNAME.";host=".DBHOST;

// on se co a la base de donnees
try{
    // on instencie PDO
        $db = new PDO($dsn, DBUSER, DBPASS);

        // permet d etre sur d'envoyer les donnees en UTF8 pour avoir les accents etc
        $db->exec("SET NAMES utf8");

        // on defini le mode de fecth par defaut
        // $db->setAttribute(PDO::ATTR_DEFAULT_FETC_MODE, PDO::FETC_ASSOC);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
    catch ( PDOException $e){
        die($e->getMessage());

    }

?>