<?php

require_once File::build_path(array('model', 'ModelUtilisateur.php')); // chargement du modèle
require_once File::build_path(array('lib', 'Session.php'));

class ControllerAdmin extends ControllerUtilisateur{

    public static function test() {
        $pagetitle = "Admin Test";
        $view = "panier";
        $controller = self::$object;
        
        echo $controller;
        require File::build_path(array("view", "view.php"));
    }

}