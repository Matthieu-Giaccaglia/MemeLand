<?php
    echo "<aside>
            <p>Le login ou le mot de passe n'est pas bon.</p>
        </aside>";
    $filepath = File::build_path(array("view", $controller, "$viewAfter.php"));
    require $filepath;
?>