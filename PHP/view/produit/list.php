<?php
echo "<h3>Liste des produits :</h3>";
echo "<ul>";
foreach ($tab_v as $v) {
    $vTypeHTML = htmlspecialchars($v->getType());
    $vTypeURL = rawurlencode($v->getType());
    echo <<< EOT
        <li> 
            Le produit de type $vTypeHTML
            <a href="?action=read&type=$vTypeURL">(+ d'info)</a>
            <a href="?action=delete&type=$vTypeHTML">(supprimer)</a>.
        </li>
EOT;
}
?>
