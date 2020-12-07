<?php

require_once File::build_path(array('model', 'ModelUtilisateur.php'));
require_once File::build_path(array('model', 'ModelCommande.php')); // chargement du modèle
 // chargement du modèle
require_once File::build_path(array('lib', 'Security.php')); //
require_once File::build_path(array('lib', 'Session.php'));

class ControllerUtilisateur{
    
    protected static $object = "utilisateur";

    

    public static function create() {
        $controller = self::$object;
        $view = 'inscription';
        $pagetitle = 'Créer un Utilisateur';
        $user = new ModelUtilisateur(array(
            'login' => "",
            'nom' => "",
            'prenom' => "",
            'email' => "",
            'nonce' => "",
            'mdp' => ""
        ));
        
        $action = "created";
        $readOrReq = "required";
        require File::build_path(array("view","view.php"));
    }

    public static function created() {
        $pagetitle = "Gestion des produits";
        if($_GET["mdp"] == $_GET["mdp_2"]) {
            $nonce = Security::generateRandomHex();
            
            $save_succesful = ModelUtilisateur::save(array(
                'login' => $_GET['login'],
                'nom' => $_GET['nom'],
                'prenom' => $_GET['prenom'],
                'email' => $_GET['email'],
                'admin' => false,
                'nonce' => $nonce,
                'mdp' => Security::hacher($_GET['mdp'])
            ));


            $mail = "https://webinfo.iutmontp.univ-montp2.fr/~deneuvillew/PHP/projet-php/PHP/index.php?controller=utilisateur&action=validate&login=" . $_GET['login'] . "&nonce=" . $nonce;
            mail('walter@yopmail.com', 'TEST', $mail);

            if ($save_succesful) {
                $controller = self::$object;
                $view = "valideMail";
                $pagetitle = 'Connexion';

            } else {
                $view = "error";
            }
        } else {
            echo "-------------------------------------------------------------------------------------------------------------------";
            $view = "error";
        }
        require File::build_path(array("view", "view.php"));
    }

    public static function validate() {
        $u = ModelUtilisateur::select($_GET['login']);
        if ($u && $u->get('nonce')==$_GET['nonce']) {
            
            $update = ModelUtilisateur::update(array(
                'login' => $u->get('login'),
                'nonce' => NULL,
                
            ));

            if ($update) {
                $controller = self::$object;
                $view = 'validate';
                $pagetitle = 'Connexion';

                require File::build_path(array("view", "view.php"));
            }
            else   
                echo 'NOT NULL';
        } else {
            echo $u->get('nonce');
            echo 'Wrong nonce';
        }
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
            
            if ($u->get('nonce') == null) {


                $_SESSION['login'] = $u->get('login');
                $_SESSION['admin'] = $u->get('admin');
                $_SESSION['nom'] = $u->get('nom');
                $_SESSION['prenom'] = $u->get('prenom');
                $_SESSION['connected'] = true;
                

                self::monCompte();
            }

        } else {
            $view = 'errorConnected';
            require File::build_path(array("view", "view.php"));
        }
    
    }

    

    public static function monCompte(){

        if ($_SESSION['connected']) {

            $u = ModelUtilisateur::select($_SESSION['login']);

            $controller = self::$object;
            $view = 'detail';
            $pagetitle = 'Mon Compte';
 

            require File::build_path(array("view", "view.php"));
        } else {
            self::connect();
        }
    }

    public static function deconnect() {

        if($_SESSION['connected']) {

            Session::delte_session();
            Session::create_session();

            ControllerSite::accueil();
        }
    }

    public static function panier(){
        $controller = self::$object;
        $view = "panier";
        $pagetitle = "Panier";

        $tab_panier = $_SESSION['panier'];
        
        require File::build_path(array("view","view.php"));
    }

    public static function changerPrixPanier($id_produit, $augmenter) {

        $p = ModelProduit::select($id_produit);
        
        if (!isset($_SESSION['prix_total']))
            $_SESSION['prix_total'] = 0;

        if($augmenter)
            $_SESSION['prix_total'] += $p->get('prix');
        else
            $_SESSION['prix_total'] -= $p->get('prix');
    }

    public static function ajoutPanier() {
        

        $tab_panier = $_SESSION['panier'];
        $index = $_GET['id_produit'];

        if(!isset($tab_panier["$index"]))
            $tab_panier["$index"] = 1;
        else
            $tab_panier["$index"]++;

        self::changerPrixPanier($index, true);

        $_SESSION['panier'] = $tab_panier;

        self::panier();
    }

    public static function enleverPanier() {
        
        $tab_panier = $_SESSION['panier'];
        $index = $_GET['id_produit'];

        if(isset($tab_panier["$index"])) {
            
            if($tab_panier["$index"] > 1) 
                $tab_panier["$index"]--;
            else if ($tab_panier["$index"] == 1)
                unset($tab_panier["$index"]);

            $_SESSION['panier'] = $tab_panier;
            self::changerPrixPanier($index, false);

            self::panier();

        } else {
            echo 'ERREUR';
            return;
        }        
    }

    public static function payer() {
        $controller = self::$object;
        

        if($_SESSION['connected'] && !empty($_SESSION['panier'])){

            $tab_panier = $_SESSION['panier'];
            ModelCommande::saveCommande($_SESSION['login'],date('Y-m-d'),$_SESSION['prix_total'], $tab_panier);


            $view = "payer";
            $pagetitle = "Payer";
            
        }else if(empty($_SESSION['panier'])){
            $view="payerVide";
            $pagetitle = "Panier Vide";
        }
        else {
            $view="pasConnexion";
            $pagetitle = "Connexion";
        }
        require File::build_path(array("view","view.php"));
    }
}