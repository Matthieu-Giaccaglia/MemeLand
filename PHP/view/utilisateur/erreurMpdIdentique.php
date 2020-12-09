<?php
    echo "<aside>
            <p>Les mots de passe ne sont pas identiques</p>
        </aside>";
    $filepath = File::build_path(array("view", $controller, "update.php"));
    require $filepath;
?>