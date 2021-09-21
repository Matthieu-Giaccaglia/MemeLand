<?php
    echo "<aside><p>Veillez Validez votre mail en vous rendant sur : <a href='http://walter.yopmail.com/'>http://walter.yopmail.com/<a> </p></aside>";
    $view="connect";
    $filepath = File::build_path(array("view", static::$object, "$view.php"));
    require $filepath;
?>