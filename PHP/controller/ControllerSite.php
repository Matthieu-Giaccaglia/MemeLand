<?php
require_once File::build_path(array('lib', 'Session.php'));

class ControllerSite{
    
    protected static $object = "site";

    public static function accueil(){

        $controller = self::$object;
        $view = "accueil";
        $pagetitle = "Accueil";
        $is_connected = Session::is_connected();

        require File::build_path(array("view","view.php"));
    }

    public static function equipe() {

        $controller = self::$object;
        $view = "equipe";
        $pagetitle = "équipe";
        $is_connected = Session::is_connected();

        require File::build_path(array("view","view.php"));
    }
}