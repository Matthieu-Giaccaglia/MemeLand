<?php
    echo "<aside>
            <p>Le produit n'existe pas.</p>
        </aside>";
    $filepath = File::build_path(array("view", "produit", "list.php"));
    require $filepath;
?>