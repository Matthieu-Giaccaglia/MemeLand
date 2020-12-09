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
    public static function deleteUser() {
        if(!is_null(myGet("login"))) {
            if( Session::is_user($_GET['login']) || Session::is_admin()) {
            
                $delete_successful = ModelUtilisateur::delete($_GET['login']);
                
                if ($delete_successful) {
                    ControllerAdmin::readAllUser();
                    return;
                } else {
                    $typeErreur = "Nous sommes désolé, le compte n'a pas pu être supprimé.";
                    ControllerSite::erreur('accueil', "Accueil", $typeErreur);
                    return;
                }
            
            } else {
                ControllerSite::accueil();
                return;
            }
        } else {
            ControllerAdmin::readAllUser();
            return;
        }
    }

    public static function erreur($afterView,$titlepage,$messageErreur) {
        if($afterView == 'listAllUser')
            $tab_user = ModelUtilisateur::selectAll();

        else if ($afterView == 'listAllProduct')
            $tab_produit = ModelProduit::selectAll();

        $controller = self::$object;
        $view = 'erreur';
        $viewAfter = $afterView;
        $typeErreur = $messageErreur;
        $pagetitle = $titlepage;
        require File::build_path(array("view","view.php"));
    }

}