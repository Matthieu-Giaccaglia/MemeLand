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
foreach ($tab_p as $p) {
    
    
    $vidProduitURL = rawurlencode($p->get("id_produit"));
    $image = $p->get("image");
    
    echo <<< EOT
        <li> 
            <a href="?controller=produit&action=read&id_produit=$vidProduitURL"><img src="./public/images/produit/$image" alt="Walter" class="perso"></a>
        </li>
EOT;
}
echo "</ul>";
?>
