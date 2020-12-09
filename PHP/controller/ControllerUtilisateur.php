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
            return;
        } else {
            ControllerSite::accueil();
            return;
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
                    require File::build_path(array("view", "view.php"));
                    return;

                } else {
                    $typeErreur = "Nous sommes désolé, votre compte n'a pas pu être créé. Veillez contacter un administateur du site.";
                    ControllerSite::erreur('equipe', "L'Équipe", $typeErreur);
                    return;
                }
            } else {
                $controller = self::$object;
                $view = 'erreurMdpIdentique';
                $pagetitle = 'Modifier son compte';
                $action = 'created';
                require File::build_path(array("view", "view.php"));
                return;
            }
        } else {
            ControllerSite::accueil();
            return;
        }

    }

    public static function update(){

        if(!is_null(myGet('login'))) {
            if( Session::is_user($_GET['login']) || Session::is_admin()) {
                $controller = self::$object;
                $view = 'update';
                $pagetitle = 'Modifier un Utilisateur';
                $action='updated';
                require File::build_path(array("view","view.php"));
                return;
            } else {
                ControllerSite::accueil();
                return;
            }
        } else {
            ControllerSite::accueil();
            return;
        }
    }

    public static function updated(){

        if(!is_null(myGet('login'))) {
            if(Session::is_user($_POST['login']) || Session::is_admin()) {
                $pagetitle='Mon compte';
                
                $updateArray = array(
                    'login' => $_POST['login'],
                    'nom' => $_POST['nom'],
                    'prenom' => $_POST['prenom'],
                    'email' => $_POST['email'],
                );
                

                if(!is_null(myGet("mdp")) && !is_null(myGet("new_mdp")) && !is_null(myGet("conf_mdp"))) {
                    if(ModelUtilisateur::checkPassword($_POST['login'],Security::hacher($_POST['mdp']))) {

                        if ($_POST["new_mdp"] == $_POST["conf_mdp"]) {
                            $updateArray['mdp'] = Security::hacher($_POST['new_mdp']);
                
                        } else {
                            $controller = self::$object;
                            $view = 'erreurMpdIdentique';
                            $pagetitle = 'Modifier son compte';
                            $action = 'updated';
                            require File::build_path(array("view", "view.php"));
                            return;
                        }

                    } else {
                        $controller = self::$object;
                        $view = 'erreurLoginMdp';
                        $viewAfter = 'update';
                        $pagetitle = 'Modifier son compte';
                        $action = 'updated';
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
                    
                    $controller = self::$object;
                    $view = 'updated';
                    $pagetitle = 'Modification Effectuée';
                    require File::build_path(array("view", "view.php"));
                    return;

                } else {
                    $typeErreur = "Nous sommes désolé, votre compte n'a pas pu être modifié. Veillez contacter un administateur du site.";
                    ControllerSite::erreur('equipe', "L'Équipe", $typeErreur);
                    return;
                }
            } else {
                ControllerSite::accueil();  
            }
        } else {
            ControllerSite::accueil();
            return;
        }
    }

    public static function delete() {

        if(!is_null(myGet("login"))) {
            if( Session::is_user($_GET['login']) || Session::is_admin()) {
            
                $delete_successful = ModelUtilisateur::delete($_GET['login']);
                
                if ($delete_successful) {
                    ControllerUtilisateur::deconnect();
                    return;
                } else {
                    $typeErreur = "Nous sommes désolé, votre compte n'a pas pu être supprimé. Veillez contacter un administateur du site.";
                    ControllerSite::erreur('equipe', "L'Équipe", $typeErreur);
                    return;
                }
            
            } else {
                ControllerSite::accueil();
                return;
            }
        } else {
            ControllerSite::accueil();
            return;
        }
    }

    public static function validate() {
        if(!is_null(myGet('login')) && !is_null(myGet('nonce'))) {

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
                    return;
                } else {   
                    $typeErreur = "Nous sommes désolé, la création de votre compte n'a pas pu aboutir. Veillez contacter un administateur du site.";
                    ControllerSite::erreur('equipe', "L'Équipe", $typeErreur);
                    return;
                }
            } else if ($u && $u->get('nonce') == NULL) { 
                $typeErreur = "Votre compte a déjà été validé.";
                ControllerSite::erreur('site', "Accueil", $typeErreur);
                return;
            } else if ($u && $u->get('nonce') != $_GET['nonce']){
                $typeErreur = "Le lien n'est plus valide.";
                ControllerSite::erreur('site', "Accueil", $typeErreur);
                return;
            } else {
                ControllerSite::accueil();
                return;
            }
        } else {
            ControllerSite::accueil();
            return;
        }
    }

    public static function connect(){
        
        if(!Session::is_connected()) {
            $controller = self::$object;
            $view = 'connect';
            $pagetitle = "Connexion";

            require File::build_path(array("view", "view.php"));
            return;
        } else {
            ControllerSite::accueil();
            return;
        }
    }

    public static function connected() {
        
        if (!Session::is_connected() && !is_null(myGet('login')) && !is_null(myGet('mdp'))) {
            if (ModelUtilisateur::checkPassword($_POST['login'], Security::hacher($_POST['mdp']))) {
                $u = ModelUtilisateur::select($_POST['login']);
                
                if ($u && $u->get('nonce') == null) {

                    $_SESSION['login'] = $u->get('login');
                    $_SESSION['admin'] = $u->get('admin');
                    $_SESSION['nom'] = $u->get('nom');
                    $_SESSION['prenom'] = $u->get('prenom');
                    $_SESSION['connected'] = true;
                    

                    self::monCompte();
                    return;
                }

            } else {
                $typeErreur = "Le login ou le mot de passe n'est pas bon.";
                self::erreur('connect', "Connexion", $typeErreur);
                return;
            }
        } else {
            ControllerSite::accueil();
            return;
        }
    
    }

    

    public static function monCompte(){

        if ($_SESSION['connected']) {

            $u = ModelUtilisateur::select($_SESSION['login']);
            $controller = self::$object;
            $view = 'detail';
            $pagetitle = 'Mon Compte';
            require File::build_path(array("view", "view.php"));
            return;
 
        } else {
            $typeErreur = "Connectez-vous afin de poursuivre votre navigation.";
            self::erreur('connect', "Connexion", $typeErreur);
            return;
        }

        
    }

    public static function deconnect() {

        if($_SESSION['connected']) {
            Session::delte_session();
            Session::create_session();
            ControllerSite::accueil();
        } else {
            $typeErreur = "Connectez-vous afin de poursuivre votre navigation.";
            self::erreur('connect', "Connexion", $typeErreur);
            return;
        }   
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
        
        if (!is_null($_GET['id_produit'])) {
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
                return;
            } else {
                $typeErreur = "Vous essayez d'ajouter un produit non disponible. Si ce n'est pas le cas, veillez contacter un administrateur";
                ControllerSite::erreur('equipe', "L'Équipe", $typeErreur);
                return;
            }
        } else {
            ControllerSite::accueil();
            return;
        }
    }

    public static function enleverPanier() {
        
        if(!isset($_SESSION['tab_panier']))
            $_SESSION['tab_panier'] = array();


        if(!is_null(('id_produit'))) {
            $index = $_GET['id_produit'];
            $tab_panier = $_SESSION['panier'];
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
                
                $typeErreur = "Vous essayez d'enlever un produit non-présent dans votre panier. Si ce n'est pas le cas, veillez contacter un administrateur";
                ControllerSite::erreur('equipe', "L'Équipe", $typeErreur);
                return;
            }  
        } else {
           
            $typeErreur = "Vous essayez d'enlever un produit non-présent dans votre panier. Si ce n'est pas le cas, veillez contacter un administrateur";
            ControllerSite::erreur('equipe', "L'Équipe", $typeErreur);
            return;
        }   
    }

    public static function payer() {
        
        

        if($_SESSION['connected'] && !empty($_SESSION['panier'])){

            $tab_panier = $_SESSION['panier'];
            ModelCommande::saveCommande($_SESSION['login'],date('Y-m-d'),$_SESSION['prix_total'], $tab_panier);

            $controller = self::$object;
            $view = "payer";
            $pagetitle = "Payer";
            require File::build_path(array("view","view.php"));
            return;
            
        }else if(empty($_SESSION['panier'])){
            self::panier();
            return;
        }
        else {
            $typeErreur = "Connectez-vous afin de poursuivre votre navigation.";
            self::erreur('connect', "Connexion", $typeErreur);
            return;
        }
       
    }

    public static function erreur($afterView,$titlepage,$messageErreur) {
        $controller = self::$object;
        $view = 'erreur';
        $viewAfter = $afterView;
        $typeErreur = $messageErreur;
        $pagetitle = $titlepage;
        require File::build_path(array("view","view.php"));
    }
}