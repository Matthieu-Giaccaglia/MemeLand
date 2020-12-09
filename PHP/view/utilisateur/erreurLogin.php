<?php
    echo "<aside>
            <p>Le login existe déjà.</p>
        </aside>";
    $filepath = File::build_path(array("view", $controller, "update.php"));
    require $filepath;
?>