<?php
    echo "<aside>
            <p>ERREUR : $typeErreur</p>
        </aside>";
    $filepath = File::build_path(array("view", $controller, "$viewAfter.php"));
    require $filepath;
?>