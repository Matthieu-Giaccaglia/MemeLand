<?php
echo "<aside><p>Le produit a bien été créée</p></aside>";
$tab_produit = ModelProduit::selectAll();
require File::build_path(array('view',self::$object,'listAllProduct.php'));
?>
