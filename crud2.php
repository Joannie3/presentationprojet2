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

<style>
    /* TABLEAU */

*, *::before, *::after{
    box-sizing: border-box;
}
table{
    width: 100%;
    border-collapse: collapse;
}

th, td{
    padding: 10px;
    text-align: left;
    border: solid 1px #ccc;
}
th{
    background-color: #000;
    color: #fff;
}
tr:nth-child(odd){
    background-color: #eee;
}

@media only screen and (max-width : 700px){

    .table-responsive table, 
    .table-responsivet head, 
    .table-responsive tbody, 
    .table-responsive tr, 
    .table-responsive th, 
    .table-responsive td {
        display: block;
    }

    .table-responsive thead{
        display: none;
    }

    .table-responsive td{
        padding-left: 150px;
        position: relative;
        background: #fff;
        margin-top:-1;
        width: 20%;
        height: auto;
    }
    /* 
    .phototable td{
        width: 5%;
    } */

    .table-responsive  img{
        width: 100%;
        height: 100%;
        border : 2px solid red;
    }


    .table-responsive td:nth-child(odd){
        background-color: #eee;
    }

    .table-responsive td::before{
        padding: 10px;
        content: attr(data-label);
        position: absolute;
        top : 0;
        left: 0;
        width: 130px;
        bottom: 0;
        background-color: black;
        color : #fff;
        display: flex;
        align-items: center;
        font-weight: bold;
    }

    .table-responsive tr{
        margin-bottom: 1rem;
    }

}
</style>

<div class="container">
    <div class="crud">
        <table class="table-responsive">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Nom du Projet</th>
                    <th>Nom du Client</th>
                    <th>Date création</th>
                    <th>créer par</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $sqlafficheprojet = "SELECT * FROM projets p, utilisateurs u
                    WHERE p.id_utilisateurs=u.id_utilisateurs
                    ORDER BY p.id_projets DESC";
                    $requeteafficheprojet = $db->prepare($sqlafficheprojet);
                    $requeteafficheprojet->execute();
                    while ($afficheprojet = $requeteafficheprojet->fetch())
                    {
                ?>
                <tr>
                    <td data-label="Photo" class="phototable"><img width="300px" height="auto" src="assets/img/projets/<?php echo $afficheprojet["image_projets"];  ?>" alt=""></td>
                    <td data-label="Nom projet"> <?php echo $afficheprojet["nom_projets"];  ?></td>
                    <td data-label="Nom client"> <?php echo $afficheprojet["client_projets"];  ?></td>
                    <td data-label="Date"> <?php echo date("d-m-Y",strtotime($afficheprojet['datecreation_projets'])); ?></td>
                    <td data-label="Créer par">aaa <?php echo $afficheprojet["prenom_utilisateurs"];  ?></td>
                </tr>
                    <?php
                    }
                    ?>
            </tbody>
        </table>



    </div>
</div>

<script src="assets/js/crud.js"></script>
<script src="assets/js/modal.js"></script>
<script src="assets/js/table.js"></script>


<?php

include 'assets/includes/footer.php';

}
?>