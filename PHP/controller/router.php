<?php

require_once File::build_path(array("controller", "ControllerProduit.php"));
require_once File::build_path(array("controller", "ControllerSite.php"));
require_once File::build_path(array("controller", "ControllerUtilisateur.php"));
require_once File::build_path(array("controller", "ControllerCommande.php"));
require_once File::build_path(array("controller", "ControllerAdmin.php"));
// On recupère l'action passée dans l'URL
$controller = 'site';

if (isset($_GET['controller']) && isset($_GET['action'])) {
    //test admin
    $controller = $_GET['controller'];
    $action = $_GET['action'];

    if ($controller == 'admin' && 
        !Session::is_admin()) {
        $controller = 'site';
        $action = 'accueil';
    }

    $controller_class ="Controller" . ucfirst($controller);

    if (!class_exists($controller_class) || !in_array($action, get_class_methods($controller_class))) {
        echo "ERREUR ROUTER";
    } else {
        $controller_class::$action();
    }
    
} else {
    ControllerSite::accueil();
}
    
?>
    
    
    