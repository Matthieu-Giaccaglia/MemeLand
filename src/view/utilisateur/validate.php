<?php
    echo "<aside><p>Vous avez validez votre mail</p></aside>";
    $view="connect";
    $filepath = File::build_path(array("view", static::$object, "$view.php"));
    require $filepath;
?>