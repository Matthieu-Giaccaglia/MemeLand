<?php

require_once File::build_path(array("controller", "ControllerProduit.php"));
require_once File::build_path(array("controller", "ControllerUtilisateur.php"));
// On recupère l'action passée dans l'URL
$controller = 'produit';
if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
}

if (isset($_GET['action'])) {
    
    $controller_class ="Controller" . ucfirst($controller);
    
    
    if (!class_exists($controller_class) || !in_array($_GET['action'], get_class_methods('ControllerVoiture'))) {
            $controller = 'produit';
            $view = 'errorRequete';
            $pagetitle = 'Erreur de Requête';
        
        require File::build_path(array("view","view.php")); 
    } else {
        $action = $_GET['action'];
        $controller_class::$action();
    }
        
} else {
    ControllerProduit::readAll();
}