<?php

require_once File::build_path(array("controller", "ControllerProduit.php"));
require_once File::build_path(array("controller", "ControllerSite.php"));
require_once File::build_path(array("controller", "ControllerUtilisateur.php"));
require_once File::build_path(array("controller", "ControllerCommande.php"));
require_once File::build_path(array("controller", "ControllerAdmin.php"));
// On recupère l'action passée dans l'URL
function myGet($nomVar){

    if (isset($_GET[$nomVar]))
        return isset($_GET[$nomVar]);
    else if(isset($_POST[$nomVar]))
        return $_POST[$nomVar];
    else
        return null;
}

$controller = 'site';

if (!is_null(myGet('controller')) && !is_null(myGet('action'))) {
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
    
    
    