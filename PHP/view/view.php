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
          <a class="navBuy" href="?controller=utilisateur&action=connect">
            <p>Connexion</p>
          </a>
          <a href="?controller=utilisateur&action=panier">
            <img class="navBuy" src="./public/images/cart.png" alt="cart" size="40%"/>
          </a>
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
                <a href="index.php?controller=utilisateur&action=create">Inscription</a>
                <a href="index.php?controller=site&action=equipe">L'Equipe</a>
              </div>
            </div>
        </nav>

        <?php

            $filepath = File::build_path(array("view", static::$object, "$view.php"));
            require $filepath;
        ?>

        <footer>
          <a href="#top"><img src="./public/images/up.png" id= "up" alt="debut"></a>
        </footer>   
    </body>
</html>