<?php
echo "<p><b>Le produit a bien été mise à jour.</b></p>";
require File::build_path(array('view',self::$object,'detail.php'));
?>