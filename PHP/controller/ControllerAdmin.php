<?php

require_once File::build_path(array('model', 'ModelUtilisateur.php')); // chargement du modèle
require_once File::build_path(array('model', 'ModelProduit.php'));
require_once File::build_path(array('lib', 'Session.php'));

class ControllerAdmin{

    protected static $object = 'admin';

    public static function readAllProduct() {

        $tab_produit = ModelProduit::selectAll();

        $controller = self::$object;
        $pagetitle = "Admin: Tous les produits";
        $view = "panelAdmin";
        $viewAdmin = "listAllProduct";
        
        
        require File::build_path(array("view", "view.php"));
    }

    public static function readAllUser() {

        $tab_user = ModelUtilisateur::selectAll();

        $controller = self::$object;
        $pagetitle = "Admin: Tous les users";
        $view = "panelAdmin";
        $viewAdmin = "listAllUser";
        
        
        require File::build_path(array("view", "view.php"));
    }

}