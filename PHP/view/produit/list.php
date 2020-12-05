<aside>
          <div class="menu_s">
            <a href=""><div class="smenu_s" onclick="location.href='./services_fils/pulls.html';"><h1>Pulls</a>
            </div>
            <a href=""><div class="smenu_s" onclick="location.href='./services_fils/shirts.html';"><h1>T-shirts</a>
            </div>
            <a href=""><div class="smenu_s" onclick="location.href='./services_fils/chaussures.html';"><h1>Chaussures</a>
            </div>
            <a href=""><div class="smenu_s" onclick="location.href='';"><h1>Pins</a></h1>
            </div><!--animation pour hover, agrandit la taille de la boite et rapetissit les autres-->
          </div>
</aside>

<?php
echo "<h3>Liste des produits :</h3>";
echo "<ul>";
foreach ($tab_p as $p) {
    
    $vidProduitHTML = htmlspecialchars($p->get("id_produit"));
    $vidProduitURL = rawurlencode($p->get("id_produit"));
    $image = $p->get("image");
    
    echo <<< EOT
        <li> 
            Produit $vidProduitHTML
            <img src="./public/images/produit/$image" alt="Walter" class="perso">
            <a href="?controller=produit&action=read&id_produit=$vidProduitURL">(+ d'info)</a>
            <a href="?controller=produit&action=delete&id_produit=$vidProduitHTML">(supprimer)</a>.
        </li>
EOT;
}
?>
