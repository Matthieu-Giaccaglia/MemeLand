<?php
    echo "<aside>
            <p>L'extension du fichier n'est pas (.jpeg, .jpg, .png) !</p>
        </aside>";
    $filepath = File::build_path(array("view", $controller, "update.php"));
    require $filepath;
?>