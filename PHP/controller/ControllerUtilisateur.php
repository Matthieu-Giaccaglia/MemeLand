<?php

require_once File::build_path(array('model', 'ModelUtilisateur.php')); // chargement du modèle
require_once File::build_path(array('lib', 'Security.php')); //
require_once File::build_path(array('lib', 'Session.php'));

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
            'email' => "",
            'mdp' => ""
        ));
        
        $action = "created";
        $readOrReq = "required";
        require File::build_path(array("view","view.php"));
    }

    public static function created() {
        $pagetitle = "Gestion des produits";
        if($_GET["mdp"] == $_GET["mdp_2"]) {
            
            $save_succesful = ModelUtilisateur::save(array(
                'login' => $_GET['login'],
                'nom' => $_GET['nom'],
                'prenom' => $_GET['prenom'],
                'email' => $_GET['email'],
                'admin' => false,
                'mdp' => Security::hacher($_GET['mdp'])
            ));
            if ($save_succesful) {
                $tab_p = ModelProduit::selectAll();
                $controller = "produit";
                $view = "created";
            } else {
                $view = "error";
            }
        } else {
            echo "-------------------------------------------------------------------------------------------------------------------";
            $view = "error";
        }
        require File::build_path(array("view", "view.php"));
    }

    public static function connect(){

        $controller = self::$object;
        $view = 'connect';
        $pagetitle = "Connexion";

        require File::build_path(array("view", "view.php"));
    }

    public static function connected() {

        
        if (ModelUtilisateur::checkPassword($_GET['login'], Security::hacher($_GET['mdp']))) {
            $u = ModelUtilisateur::select($_GET['login']);
            
            if ($u->get('admin'))
                echo 'ADMIN PUTAIN DE MERDE';
            else
                echo 'PAS ADMIN PUTAIN DE MERDE';


            $_SESSION['login'] = $u->get('login');
            $_SESSION['admin'] = $u->get('admin');
            

            $controller = self::$object;
            $view = 'detail';
            $pagetitle = 'Mon compte';
        } else {
            $view = 'erreur';
        }

        require File::build_path(array("view", "view.php"));
    }
}