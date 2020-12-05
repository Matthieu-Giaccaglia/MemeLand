<aside>
          <div class="menu_s">
            <a href="?controller=produit&action=readCategorie&categorie_id=pull"><div class="smenu_s" onclick="location.href='?controller=produit&action=readCategorie&categorie_id=pull';"><h1>Pulls</a>
            </div>
            <a href=""><div class="smenu_s" onclick="location.href='';"><h1>T-shirts</a>
            </div>
            <a href=""><div class="smenu_s" onclick="location.href='';"><h1>Chaussures</a>
            </div>
            <a href="?controller=produit&action=readCategorie&categorie_id=pins"><div class="smenu_s" onclick="location.href='?controller=produit&action=readCategorie&categorie_id=pins';"><h1>Pins</a></h1>
            </div><!--animation pour hover, agrandit la taille de la boite et rapetissit les autres-->
          </div>
</aside>

<?php
echo "<section><h3>Liste des produits :</h3>";
echo "<main><ul>";
foreach ($tab_p as $p) {
    
    
    $vidProduitURL = rawurlencode($p->get("id_produit"));
    $image = $p->get("image");
    
    echo <<< EOT
        <li> 
            <a href="?controller=produit&action=read&id_produit=$vidProduitURL"><img src="./public/images/produit/$image" alt="produit_image"></a>
        </li>
EOT;
}
echo "</ul>";
echo "</ul></main></section>";
?>
