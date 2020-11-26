<?php
$vIdProduit = htmlspecialchars($idProduit);
echo "<p>Le produit $vIdProduit a bien été supprimée</p>";
require File::build_path(array('view',self::$object,'list.php'));
?>
