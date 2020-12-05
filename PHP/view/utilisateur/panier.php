<?php
$tab_panier = ["1","2"];
echo "<section><h3>Liste des produits Util :</h3>";
echo "<main><ul>";
foreach ($tab_panier as $prod_p) {
    $produit = ModelProduit::select($prod_p);
    
    $vidProduitURL = rawurlencode($produit->get("id_produit"));
    $image = $produit->get("image");
    
    echo <<< EOT
        <li> 
            <a href="?controller=produit&action=read&id_produit=$vidProduitURL"><img src="./public/images/produit/$image" alt="produit_image"></a>
        </li>
EOT;
}
echo "</ul>";
echo "</ul></main></section>";
?>
