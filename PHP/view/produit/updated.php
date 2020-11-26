<?php
$vImmat = htmlspecialchars($immat);
echo "<p>La voiture d'immatriculation $vImmat a bien été mise à jour.</p>";
require File::build_path(array('view',self::$object,'list.php'));
