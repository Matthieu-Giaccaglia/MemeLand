<?php
$vIdProduit = htmlspecialchars($idProduit);
echo "<p>Le produit $vIdProduit a bien été mise à jour.</p>";
require File::build_path(array('view',self::$object,'list.php'));
?>