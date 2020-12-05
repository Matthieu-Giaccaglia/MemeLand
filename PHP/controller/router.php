<?php

require_once File::build_path(array("controller", "ControllerProduit.php"));
require_once File::build_path(array("controller", "ControllerSite.php"));
require_once File::build_path(array("controller", "ControllerUtilisateur.php"));
// On recupère l'action passée dans l'URL
$controller = 'site';

if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
    //echo $controller;
}

if (isset($_GET['action'])) {
    
    $controller_class ="Controller" . ucfirst($controller);
    //echo $controller_class;
    
    
    if (!class_exists($controller_class) || !in_array($_GET['action'], get_class_methods($controller_class))) {
            /*$controller = 'produit';
            $view = 'errorRequete';
            $pagetitle = 'Erreur de Requête';
        
            require File::build_path(array("view","view.php"));*/
            //echo "ERRREURRRR"; 
    } else {
        $action = $_GET['action'];
        //echo $action;
        $controller_class::$action();
    }
        
} else {
    ControllerSite::accueil();
}