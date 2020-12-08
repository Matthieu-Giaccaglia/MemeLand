<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="./public/styles/Back.css">
        <title><?php echo $pagetitle; ?></title>
    </head>
    <body>
        <header>
          <p id="top">
            <img src="./public/images/MemeLand.png" alt="Logo" height="312" width="260">
          </p>
        </header>

        <article>
          <div class="navBuy">
            <div class="navBuySon">
<?php
    if($_SESSION['connected']) {
      $nom = $_SESSION['nom'] . " " . $_SESSION['prenom'];
      echo <<<EOT
          <a href="?controller=utilisateur&action=monCompte">
            <p>$nom</p>
          </a>
EOT;
    } else {
        echo <<<EOT
        <a href="?controller=utilisateur&action=connect">
            <p>Se connecter</p>
        </a>
EOT;

              }
              ?>
            </div>
            <div class="navBuySon">
              <a href="?controller=utilisateur&action=panier">
                <img class="cart_small" src="./public/images/cart.png" alt="cart"/>
              </a>
            </div>
          </div>
        </article>

        <nav>
            <div class="dropdown">
              <button class="dropbtn">
                <img src="./public/images/MemeLand.png" alt="Logo"  height="156" width="130">
                <img id="logoOver" src="./public/images/Pepe_eyesspace.png" alt="Logo"  height="156" width="130">
              </button>
              <div class="dropdown-content">
                <a href="index.php?controller=site&action=accueil">Accueil</a>
                <a href="index.php?controller=produit&action=readAll">Produits</a>
                <?php 
                  if($_SESSION['connected']) {
                    if($_SESSION['login']){
                        echo "<a href='?controller=commande&action=mesCommades'>Mes commande</a>";
                    }
                    echo "<a href='?controller=utilisateur&action=monCompte'>Mon compte</a>";
                  }else{ 
                    echo "<a href='index.php?controller=utilisateur&action=create'>Inscription</a>";
                  }

                  if (Session::is_admin()) {
                    echo "<a href='?controller=produit&action=create'>Créer un produit</a>";
                  }

                ?>
                <a href="index.php?controller=site&action=equipe">L'Equipe</a>
              </div>
            </div>
        </nav>

        <?php

            $filepath = File::build_path(array("view", $controller, "$view.php"));
            require $filepath;
        ?>

        <footer>
          <a href="#top"><img src="./public/images/up.png" id= "up" alt="debut"></a>
        </footer>   
    </body>
</html>