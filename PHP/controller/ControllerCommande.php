<?php
require_once File::build_path(array('model', 'ModelCommande.php'));
require_once File::build_path(array('model', 'ModelListeArticle.php'));
require_once File::build_path(array('lib', 'Security.php')); 
require_once File::build_path(array('lib', 'Session.php'));

class ControllerCommande {

    protected static $object = "commande";

    public static function mesCommandes() {
        if (Session::is_connected()) {

            $tab_c = ModelCommande::readCommande($_SESSION['login']);
            $controller = self::$object;
            $view = 'list';
            $pagetitle = 'Mes Commandes';
        } else {
            $controller = 'site';
            $view = 'accueil';
            $pagetitle = 'Accueil';
        }

        require File::build_path(array("view","view.php"));
    }

    public static function maCommandeDetail(){

        if(Session::is_connected() && Session::is_user($_GET['login'])) {

            $controller = self::$object;
            
            $c = ModelCommande::select($_GET['id_commande']);

            if(!$c){
                $typeErreur = "La Commande n'existe pas";
                ControllerCommande::erreur('list', 'Liste Commandes', $typeErreur);
                return;
            } 

            $tab_listProduit = ModelListeArticle::selectAllProduit($_GET['id_commande']);

            if(!$tab_listProduit){
                $typeErreur = "Get Liste Produit de la Commande";
                ControllerCommande::erreur('list', 'Liste Commandes', $typeErreur);
                return;
            } else {
                $view = 'detail';
                $pagetitle = 'Détail de ma Commande';
            }
            
        } else {
            $controller = 'site';
            $view = 'accueil';
            $pagetitle = 'Accueil';
        }
        require File::build_path(array("view","view.php"));   
    }

    public static function delete() {
        if(Session::is_connected() && Session::is_user($_GET['login'])) {
            $view = "deleted";
            $pagetitle = "Delete Commande";
            $controller = self::$object;
            
            $delete_successful = ModelCommande::delete($_GET['id_commande']);
            
            if (!$delete_successful) {
                $typeErreur = "La commmande n'as pas été trouvé pour delete";
                ControllerCommande::erreur('list', 'Liste Commandes', $typeErreur);
                return;
            }
        } else {
            $controller = 'site';
            $view = 'accueil';
            $pagetitle = 'Accueil';
        }
        
        require File::build_path(array("view", "view.php"));
    }

    public static function update() {
        if(Session::is_connected() && Session::is_user($_GET['login'])) {
            $commande = ModelCommande::select($_GET['id_commande']);
            $controller = self::$object;

            if ($commande) {
                $view = 'update';
                $pagetitle = 'Modifier une commande';
                
                $action = "updated";
                $required = false;
            } else {
                $typeErreur = "La commande n'existe pas";
                ControllerCommande::erreur('list', 'Liste Commandes', $typeErreur);
                return;
            }
        } else {
            $controller = 'site';
            $view = 'accueil';
            $pagetitle = 'Accueil';
        }
        
        require File::build_path(array("view", "view.php"));
    }

    public static function updated() {
        if(Session::is_connected() && Session::is_user($_GET['login'])) {
            
            $updateArray = array(
                'id_commande' => $_GET['id_commande'],
                'date' => $_GET['date']
            );

            ModelCommande::update($updateArray);
            
            $c = ModelCommande::select($_GET['id_commande']); 
            
            $controller = 'commande';
            $view = 'updated';
            $pagetitle = 'Modification Effectuée';
        
        } else {
            $controller = 'site';
            $view = 'accueil';
            $pagetitle = 'Accueil';
        }
        
        require File::build_path(array("view", "view.php"));
        
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



?>