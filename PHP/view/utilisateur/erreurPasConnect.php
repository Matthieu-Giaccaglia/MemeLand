<?php
    echo "<aside><p>Connectez-vous afin de poursuivre vos votre navigation</p></aside>";
    $view="connect";
    $filepath = File::build_path(array("view", static::$object, "$view.php"));
    require $filepath;
?>