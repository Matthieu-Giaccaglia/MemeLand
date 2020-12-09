<?php

    echo "<aside>
              <div class='menu_s'>
                <a href='?controller=admin&action=readAllUser'><div class='smenu_s' onclick='location.href='?controller=admin&action=readAllUser';'><h1>Tous les utilisateurs</a>
                </div>
                <a href='?controller=admin&action=readAllProduct'><div class='smenu_s' onclick='location.href='?controller=admin&action=readAllProduct';'><h1>Tous les Produits</a></h1>
                </div><!--animation pour hover, agrandit la taille de la boite et rapetissit les autres-->
              </div>
          </aside>
          <aside>
              <div class='menu_s'>
                <a href='?controller=utilisateur&action=create'><div class='smenu_s' onclick='location.href='?=utilisateur&action=create';'><h1>Créer un utilisateur</a>
                </div>
                <a href='?controller=produit&action=create'><div class='smenu_s' onclick='location.href='?=produit&action=create';'><h1>Créer un produit</a></h1>
                </div><!--animation pour hover, agrandit la taille de la boite et rapetissit les autres-->
              </div>
          </aside>";

    $filepath = File::build_path(array("view", 'admin', "$viewAdmin.php"));
    require $filepath;
?>
