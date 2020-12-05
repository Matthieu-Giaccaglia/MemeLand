<?php

require_once File::build_path(array('model', 'ModelUtilisateur.php')); // chargement du modèle

class ControllerUtilisateur{
    
    protected static $object = "utilisateur";

    public static function panier(){
        $controller = self::$object;
        $view = "panier";
        $pagetitle = "Panier";

        $tab_panier = $_SESSION['panier'];

        require File::build_path(array("view","view.php"));
    }

    public static function ajoutPanier() {
        
        $tab_panier = $_SESSION['panier'];
        $id_produit = $_GET["id_produit"];
        array_push($tab_panier, $id_produit);
        $_SESSION['panier'] = $tab_panier;

        $controller = self::$object;
        $view = "ajoutPanier";
        $pagetitle = "Détails du produit";

        $p = ModelUtilisateur::select($id_produit);

        require File::build_path(array("view","view.php"));
    }

    public static function create() {
        $controller = self::$object;
        $view = 'inscription';
        $pagetitle = 'Créer un Utilisateur';
        $user = new ModelUtilisateur(array(
            'login' => "",
            'nom' => "",
            'prenom' => "",
            'nonce' => "",
            'email' => "",
            'mdp' => ""
        ));
        
        $action = "created";
        $readOrReq = "required";
        require File::build_path(array("view","view.php"));
    }

    public static function created() {
        $pagetitle = "Gestion des produits";
            
        $save_succesful = ModelUtilisateur::save(array(
            'login' => $_GET['login'],
            'nom' => $_GET['nom'],
            'prenom' => $_GET['prenom'],
            'nonce' => $_GET['nonce'],
            'email' => $_GET['email'],
            'mdp' => $_GET['mdp']
        ));
        if ($save_succesful) {
            $tab_p = ModelProduit::selectAll();
            $controller = "produit";
            $view = "created";
        } else {
            $view = "error";
        }
        
        require File::build_path(array("view", "view.php"));
    }
}