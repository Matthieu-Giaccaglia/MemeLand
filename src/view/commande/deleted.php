<?php
echo "<aside><p>La commande ".$_GET['id_commande']." a bien été supprimée</p></aside>";
require File::build_path(array('view',self::$object,'list.php'));
?>
