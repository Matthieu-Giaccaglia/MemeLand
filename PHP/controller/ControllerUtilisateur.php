<?php

require_once File::build_path(array('model', 'ModelUtilisateur.php'));
require_once File::build_path(array('model', 'ModelCommande.php'));
require_once File::build_path(array('lib', 'Security.php')); //
require_once File::build_path(array('lib', 'Session.php'));

class ControllerUtilisateur{
    
    protected static $object = "utilisateur";

    
    public static function create() {

        if(!Session::is_connected() || Session::is_admin()) {
            
            
            $action = "created";
    
            $controller = self::$object;
            $view = 'update';
            $pagetitle = 'Créer un Utilisateur';

            require File::build_path(array("view","view.php"));
        } else {
            ControllerSite::accueil();
        }
        
    }

    public static function created() {
        
        if(!Session::is_connected() || Session::is_admin()) {
        
            if($_POST["mdp"] == $_POST["conf_mdp"]) {

                $nonce = Security::generateRandomHex();
                
                $save_succesful = ModelUtilisateur::save(array(
                    'login' => $_POST['login'],
                    'nom' => $_POST['nom'],
                    'prenom' => $_POST['prenom'],
                    'email' => $_POST['email'],
                    'admin' => isset($_POST['admin']),
                    'nonce' => $nonce,
                    'mdp' => Security::hacher($_POST['mdp'])
                ));


                $mail = "Bonjour" . $_POST['prenom'] . ",\n

                        Pour valider votre mail, veillez cliquer sur le lien ci-dessous :\n
                        https://webinfo.iutmontp.univ-montp2.fr/~deneuvillew/PHP/projet-php/PHP/index.php?controller=utilisateur&action=validate&login=" . $_POST['login'] . "&nonce=" . $nonce ."\n
                        \n
                        Cordialement,\n
                        L'Équipe Meme Land";
                mail('walter@yopmail.com', $_POST['prenom'] . " Validation Mail 'Meme Land'", $mail);

                if ($save_succesful) {
                    $controller = self::$object;
                    $view = "valideMail";
                    $pagetitle = 'Connexion';

                } else {
                    $controller = 'site';
                    $view = "erreur";
                    $viewAfter = 'equipe';
                    $pagetitle = "ERREUR CREATION COMPTE";
                    $typeErreur = "Nous sommes désolé, votre compte n'a pas pu être créé. Veillez contacter un administateur du site.";
                    require File::build_path(array("view", "view.php"));
                    return;
                }
            } else {
                $controller = self::$object;
                $view = 'erreurMpdIdentique';
                $action = 'created';
                $pagetitle = 'Créer un Utilisateur';
            }
                

            require File::build_path(array("view", "view.php"));
            

        } else {
            ControllerSite::accueil();
        }

    }

    public static function update(){

        if(Session::is_user($_GET['login']) || Session::is_admin()) {
            $controller = self::$object;
            $view = 'update';
            $pagetitle = 'Modifier un Utilisateur';
            $user = ModelUtilisateur::select($_GET['login']);
            
            $action = "updated";
            $readOrReq = "readonly";
            $createOrUpdate = "Modifier";
            $old = "Ancien ";
            $reqMdp = "";
            require File::build_path(array("view","view.php"));
        } else {
            ControllerSite::accueil();
        }
    }

    public static function updated(){

        if(Session::is_user($_POST['login']) || Session::is_admin()) {
            $pagetitle='Mon compte';
            
            $updateArray = array(
                'login' => $_POST['login'],
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'email' => $_POST['email'],
            );
            

            if(isset($_POST["mdp"]) && isset($_POST["new_mdp"]) && isset($_POST["conf_mdp"])) {
                if(ModelUtilisateur::checkPassword($_POST['login'],Security::hacher($_POST['mdp']))) {

                    if ($_POST["new_mdp"] == $_POST["conf_mdp"]) {
                        $updateArray['mdp'] = Security::hacher($_POST['new_mdp']);
                        var_dump($updateArray);
                    } else {
                        $controller = self::$object;
                        $view = 'erreurMdpIdentique';
                        $pagetitle = 'Modifier son compte';
                        $action = 'updated';
                        require File::build_path(array("view", "view.php"));
                        return;
                    }

                } else {
                        $controller = self::$object;
                        $view = 'erreurConnected';
                        $viewAfter = 'update';
                        $pagetitle = 'MDP PAS BON';
                        require File::build_path(array("view", "view.php"));
                        return;
                }
            } 
                 
            if(Session::is_admin()){
                $updateArray['admin'] = isset($_POST['admin']);
            }

            $update_succesful = ModelUtilisateur::update($updateArray);
        
            if ($update_succesful) {
                $u = ModelUtilisateur::select($_POST['login']); 
                
                $controller = 'utilisateur';
                $view = 'updated';
                $pagetitle = 'Modification Effectuée';
                $action = 'updated';

            } else {
                $controller = 'site';
                $view = "erreur";
                $viewAfter = 'equipe';
                $pagetitle = "ERREUR MODIFICATION COMPTE";
                $typeErreur = "Nous sommes désolé, votre compte n'a pas pu être modifié. Veillez contacter un administateur du site.";
            }
            require File::build_path(array("view", "view.php"));
        
        
        } else {
            ControllerSite::accueil();  
        }  
    }

    public static function delete() {

        if( Session::is_user($_GET['login']) || Session::is_admin()) {
        
            $delete_successful = ModelUtilisateur::delete($_GET['login']);
            
            if ($delete_successful) {
                ControllerUtilisateur::deconnect();
            } else {
                $controller = 'site';
                $view = "erreur";
                $viewAfter = 'equipe';
                $pagetitle = "ERREUR SUPPRESSION COMPTE";
                $typeErreur = "Nous sommes désolé, votre compte n'a pas pu être supprimé. Veillez contacter un administateur du site.";
                require File::build_path(array("view", "view.php"));
            }
         
        } else {
            ControllerSite::accueil();
        }
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
        
        if(!Session::is_connected()) {
            $controller = self::$object;
            $view = 'connect';
            $pagetitle = "Connexion";

            require File::build_path(array("view", "view.php"));
        } else {
            ControllerSite::accueil();
        }
    }

    public static function connected() {
        
        if (!Session::is_connected()) {
            if (ModelUtilisateur::checkPassword($_POST['login'], Security::hacher($_POST['mdp']))) {
                $u = ModelUtilisateur::select($_POST['login']);
                
                if ($u->get('nonce') == null) {

                    $_SESSION['login'] = $u->get('login');
                    $_SESSION['admin'] = $u->get('admin');
                    $_SESSION['nom'] = $u->get('nom');
                    $_SESSION['prenom'] = $u->get('prenom');
                    $_SESSION['connected'] = true;
                    

                    self::monCompte();
                }

            } else {
                $controller = self::$object;
                $view = 'erreurConnected';
                $viewAfter = 'connect';
                $pagetitle = 'MDP PAS BON';
                require File::build_path(array("view", "view.php"));
            }
        } else {
            ControllerSite::accueil();
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
            $controller = self::$object;
            $view = 'erreurPasConnect';
            $pagetitle = 'Connexion';
        }
    }

    public static function deconnect() {

        if($_SESSION['connected']) {
            Session::delte_session();
            Session::create_session();
        }
        ControllerSite::accueil();
    }

    public static function panier(){
        $controller = self::$object;
        $view = "panier";
        $pagetitle = "Panier";

        if (!isset($_SESSION['tab_panier']))
            $_SESSION['tab_panier'] = array();

        $tab_panier = $_SESSION['panier'];
        require File::build_path(array("view","view.php"));
    }

    private static function changerPrixPanier($id_produit, $augmenter) {

        $p = ModelProduit::select($id_produit);
        
        if (!isset($_SESSION['prix_total']))
            $_SESSION['prix_total'] = 0;

        if($augmenter)
            $_SESSION['prix_total'] += $p->get('prix');
        else
            $_SESSION['prix_total'] -= $p->get('prix');
    }

    public static function ajoutPanier() {
        

        if(!isset($_SESSION['panier']))
            $_SESSION['panier'] = array();

        $produit_exist = ModelProduit::select($_GET['id_produit']);
            
            if($produit_exist && $produit_exist->get('disponible')) {
            $tab_panier = $_SESSION['panier'];
            $index = $_GET['id_produit'];

            if(!isset($tab_panier["$index"]))
                $tab_panier["$index"] = 1;
            else
                $tab_panier["$index"]++;

            self::changerPrixPanier($index, true);

            $_SESSION['panier'] = $tab_panier;

            self::panier();
        } else {
            ControllerProduit::erreurProduit();
        }
    }

    public static function enleverPanier() {
        
        if(isset($_SESSION['tab_panier']))
            $_SESSION['tab_panier'] = array();

        $tab_panier = $_SESSION['tab_panier'];


        if(isset($_GET['id_produit'])) {
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
                return;

            } else {
                $controller = self::$object;
                $view = 'erreur';
                $viewAfter = 'panier';
                $pagetitle = 'Panier';
                $typeErreur = "Vous essayez d'enlever un produit non-présent dans votre panier. Si c'est pas le cas, veillez contacté un administrateur";
            }  
        } else {
            $controller = self::$object;
            $view = 'erreur';
            $viewAfter = 'panier';
            $pagetitle = 'Panier';
            $typeErreur = "Vous essayez d'enlever un produit non-présent dans votre panier. Si c'est pas le cas, veillez contacté un administrateur"; 
        }     
    }

    public static function payer() {
        $controller = self::$object;
        

        if($_SESSION['connected'] && !empty($_SESSION['panier'])){

            $tab_panier = $_SESSION['panier'];
            var_dump($tab_panier);
            ModelCommande::saveCommande($_SESSION['login'],date('Y-m-d'),$_SESSION['prix_total'], $tab_panier);


            $view = "payer";
            $pagetitle = "Payer";
            
        }else if(empty($_SESSION['panier'])){
            self::panier();
            return;
        }
        else {
            $view="erreurConnection";
            $pagetitle = "Connexion";
        }
        require File::build_path(array("view","view.php"));
    }
}