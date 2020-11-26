<?php

require_once File::build_path(array('model', 'ModelVoiture.php')); // chargement du modèle

class ControllerVoiture {

    protected static $object = 'voiture';

    public static function readAll() {
        $tab_v = ModelVoiture::selectAll();     //appel au modèle pour gerer la BD
        $view = "list";
        $pagetitle = "Gestion des voitures";
        require File::build_path(array("view", "view.php"));
    }

    public static function read() {
        $pagetitle = "Gestion des voitures";
        if (isset($_GET['immat'])) {
            $immat = $_GET['immat'];
            $v = ModelVoiture::select($immat);
            if ($v === false) {
                $view = "error";
            } else {
                $view = "detail";
            }
        } else {
            $view = "error";
        }
        require File::build_path(array("view", "view.php"));
    }

    public static function create() {
        $view = "update";
        $pagetitle = "Gestion des voitures";
        $immatHTML = "";
        $marqueHTML = "";
        $couleurHTML = "";
        $next_action = "created";
        $primary_property = "required";
        require File::build_path(array("view", "view.php"));
    }

    public static function created() {
        $pagetitle = "Gestion des voitures";
        if (isset($_GET['immatriculation']) && isset($_GET['marque']) && isset($_GET['couleur'])) {
            $v = new ModelVoiture($_GET['marque'], $_GET['couleur'], $_GET['immatriculation']);
            $save_succesful = $v->save();
            if ($save_succesful) {
                $tab_v = ModelVoiture::selectAll();
                $view = "created";
            } else {
                $view = "error";
            }
        } else {
            $view = "error";
        }
        require File::build_path(array("view", "view.php"));
    }

    public static function error() {
        $view = "error";
        $pagetitle = "Gestion des voitures";
        require File::build_path(array("view", "view.php"));
    }

    public static function delete() {
        $view = "deleted";
        $pagetitle = "Gestion des voitures";

        if (isset($_GET['immat'])) {
            $immat = $_GET['immat'];
            $delete_successful = ModelVoiture::delete($_GET['immat']);
            $tab_v = ModelVoiture::selectAll();
            if ($delete_successful) {
                $view = "deleted";
            } else {
                $view = "error";
            }
        } else {
            $view = "error";
        }
        require File::build_path(array("view", "view.php"));
    }

    public static function update() {
        $view = "update";
        $pagetitle = "Gestion des voitures";
        if (isset($_GET['immatriculation']) && isset($_GET['marque']) && isset($_GET['couleur'])) {
            $immatHTML = htmlspecialchars($_GET['immatriculation']);
            $marqueHTML = htmlspecialchars($_GET['marque']);
            $couleurHTML = htmlspecialchars($_GET['couleur']);
            $next_action = "updated";
            $primary_property = "readonly";
            $view = 'update';
        } else {
            $view = "error";
        }
        require File::build_path(array("view", "view.php"));
    }

    public static function updated() {
        $pagetitle = "Gestion des voitures";
        if (isset($_GET['immatriculation']) && isset($_GET['marque']) && isset($_GET['couleur'])) {
            $data = array(
                "marque" => $_GET['marque'],
                "couleur" => $_GET['couleur'],
                "immatriculation" => $_GET['immatriculation']
            );
            $immat = $_GET['immatriculation'];
            $update_successful = ModelVoiture::update($data);
            if ($update_successful) {
                $tab_v = ModelVoiture::selectAll();
                $view = "updated";
            } else {
                $view = "error";
            }
        } else {
            $view = "error";
        }
        require File::build_path(array("view", "view.php"));
    }

}
