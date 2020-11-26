<?php
$vIdProduit = htmlspecialchars($idProduit);
echo "<p>La voiture d'immatriculation $vIdProduit a bien été mise à jour.</p>";
require File::build_path(array('view',self::$object,'list.php'));
?>