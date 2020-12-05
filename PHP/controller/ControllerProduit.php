<?php

require_once File::build_path(array('model', 'ModelProduit.php')); // chargement du modèle

class ControllerProduit {

    protected static $object = 'produit';

    public static function readAll() {
        $tab_p = ModelProduit::selectAll();     //appel au modèle pour gerer la BD

        $controller = 'produit';
        $view = "list";
        $pagetitle = "Tous les produits";
        require File::build_path(array("view", "view.php"));
    }

    public static function read() {
        $p = ModelProduit::select($_GET["id_produit"]);
        if ($p == false){
            $controller = 'produit';
            $view = 'errorProduit';
            $pagetitle = 'Erreur';
        
            require File::build_path(array("view","view.php"));
        } else {
            $controller = 'produit';
            $view = 'detail';
            $pagetitle = 'Détails du produit';
        
            require File::build_path(array("view","view.php"));
        }
    }

    public static function create() {
        $controller = 'produit';
        $view = 'update';
        $pagetitle = 'Créer un produit';
        
        $produit = new ModelProduit(array(
            'produit_id' => "",
            'nom' => "",
            'description' => "",
            'prix' => "",
            'categorie_id' => "",
            'couleur' => "",
            'image' => ""
        ));
        
        $action = "created";
        $readOrReq = "required";
        
        require File::build_path(array("view","view.php"));
    }

    public static function created() {
        $pagetitle = "Gestion des produits";
        
            
         $save_succesful = ModelProduit::save(array(
            'idProduit' => $_GET['idProduit'],
            'nom' => $_GET['nom'],
            'description' => $_GET['description'],
            'prix' => $_GET['prix'],
            'idCategorie' => $_GET['idCategorie'],
        ));
        if ($save_succesful) {
            $tab_v = ModelProduit::selectAll();
            $view = "created";
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
        $pagetitle = "Gestion des produits";

        
        $immat = $_GET['idProduit'];
        $delete_successful = ModelProduit::delete($_GET['idProduit']);
        
        if ($delete_successful) {
            $tab_p = ModelProduit::selectAll();

            $controller = self::$object;
            $view = "deleted";
            $pagetitle = "Produit supprimée";
         } else {
            $controller = self::$object;
            $view = "error";
        }
        
        require File::build_path(array("view", "view.php"));
    }

    public static function update() {
        $produitUpdate = $_GET["id_produit"];
        echo $produitUpdate;
        $produit = ModelProduit::select($produitUpdate);
        
        if ($produit) {
            $controller = self::$object;
            $view = 'update';
            $pagetitle = 'Modifier un produit';
            
            $action = "updated";
            $readOrReq = "readonly";
        
            require File::build_path(array("view","view.php"));
        } else {
            $controller = 'produit';
            $view = 'errorDelete';
            $pagetitle = 'Erreur de suppression';

            require File::build_path(array("view","view.php"));
            die();
        }
    }

    public static function updated() {
        require_once File::build_path(array("model","ModelProduit.php"));
        
        ModelProduit::update(array(
            'id_produit' => $_GET["id_produit"],
            'nom' => $_GET['nom'],
            'description' => $_GET['description'],
            'prix' => $_GET['prix'],
            'categorie_id' => $_GET['categorie_id'],
            'image' => $_GET['image'],
            'couleur' => $_GET['couleur']
        ));
        
        $p = ModelProduit::select($_GET["id_produit"]); 
        
        $controller = 'produit';
        $view = 'updated';
        $pagetitle = 'Modification Effectuée';
        
        require File::build_path(array("view","view.php"));
    }

}
