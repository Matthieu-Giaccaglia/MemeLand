<aside>
          <div class="menu_s">
            <a href="?controller=admin&action=readAllUser"><div class="smenu_s" onclick="location.href='?controller=admin&action=readAllUser';"><h1>Tous les utilisateurs</a>
            </div>
            <a href="?controller=admin&action=readAllProduct"><div class="smenu_s" onclick="location.href='?controller=admin&action=readAllProduct';"><h1>Tous les Produits</a></h1>
            </div><!--animation pour hover, agrandit la taille de la boite et rapetissit les autres-->
          </div>
</aside>

<?php
    $filepath = File::build_path(array("view", static::$object, "$viewAdmin.php"));
    require $filepath;
?>
<p>fin</p>