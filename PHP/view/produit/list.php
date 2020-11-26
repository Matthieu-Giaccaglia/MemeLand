<?php
echo "<h3>Liste des produits :</h3>";
echo "<ul>";
foreach ($tab_v as $v) {
    $vidProduitHTML = htmlspecialchars($v->getidProduit());
    $vidProduitURL = rawurlencode($v->getidProduit());
    echo <<< EOT
        <li> 
            Le produit $vidProduitHTML de 
            <a href="?action=read&idProduit=$vidProduitURL">(+ d'info)</a>
            <a href="?action=delete&idProduit=$vidProduitHTML">(supprimer)</a>.
        </li>
EOT;
}
?>
