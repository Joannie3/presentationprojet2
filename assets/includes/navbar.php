<nav class="navbar dark-mode">

    <div class="navbar__logo"><img src="assets/img/logo.png" alt="logo"></div>

    <ul class="navbar__links">

        <li class="navbar__link first"><a href="index.php">Accueil</a></li>
        <li class="navbar__link two "><a href="#">Nous contacter</a></li>

        <?php
            if (isset($_SESSION["membres"]["id"])){
                echo '<li class="navbar__link four"><a href="ajouterprojet.php">Ajouter projet</a></li>';
                echo '<li class="navbar__link four"><a href="deconnexion.php" class="negatif">Déconnexion</a></li>';
            }
            else {
            echo '        
            <li class="navbar__link third"><a href="inscription.php">Inscription</a></li>
            <li class="navbar__link four"><a href="connexion.php">Connexion</a></li>
            ';
            }
        ?>


    </ul>

    <button class="burger">

        <span class="bar"></span>

    </button>
</nav>

<script src="assets/js/menu.js"></script>