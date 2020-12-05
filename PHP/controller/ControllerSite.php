<?php

class ControllerSite{
    
    protected static $object = "site";

    public static function accueil(){

        $controller = self::$object;
        $view = "accueil";
        $pagetitle = "Accueil";

        require File::build_path(array("view","view.php"));
    }

    public static function equipe() {

        $controller = self::$object;
        $view = "equipe";
        $pagetitle = "équipe";

        require File::build_path(array("view","view.php"));
    }
}