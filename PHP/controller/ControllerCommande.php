<?php
require_once File::build_path(array('model', 'ModelCommande.php'));
require_once File::build_path(array('model', 'ModelListeArticle.php'));
require_once File::build_path(array('lib', 'Security.php')); 
require_once File::build_path(array('lib', 'Session.php'));

class ControllerCommande {

    protected static $object = "commande";

    public static function mesCommandes() {

        echo 'MESCOMMANDES';
        if (Session::is_connected()) {

            $tab_c = ModelCommande::readCommande($_SESSION['login']);
            $controller = self::$object;
            $view = 'list';
            $pagetitle = 'Mes Commandes';
            var_dump($tab_c);
        } else {
            echo 'PAS Connecté';
        }

        require File::build_path(array("view","view.php"));
    }

    public static function maCommandeDetail(){

        if(Session::is_connected() && Session::is_user($_GET['login'])) {

            $controller = self::$object;
            
            $c = ModelCommande::select($_GET['id_commande']);
            $tab_listProduit = ModelListeArticle::selectAllProduit($_GET['id_commande']);

            var_dump($tab_listProduit);

            if(!$tab_listProduit){
                echo "PAS PRODUIT DANS COMMANDE";
            } else {
                $view = 'detail';
                $pagetitle = 'Détail de ma Commande';
                require File::build_path(array("view","view.php"));
            }
            
        } else {
            echo Session::is_connected();
            echo Session::is_user($_GET['login']);
            echo "PAS CONNECTE";
        }   
    }

    public static function delete() {
        $view = "deleted";
        $pagetitle = "Delete Commande";
        $controller = self::$object;
        
        $delete_successful = ModelCommande::delete($_GET['id_commande']);
        
        if (!$delete_successful) {
            $view = "error";
        }
        
        require File::build_path(array("view", "view.php"));
    }

    public static function update() {
        $commande = ModelCommande::select($_GET['id_commande']);
        $controller = self::$object;

        if ($commande) {
            $view = 'update';
            $pagetitle = 'Modifier une commande';
            
            $action = "updated";
            $required = false;
        
            require File::build_path(array("view","view.php"));
        } else {
            $view = 'error';
            $pagetitle = 'Erreur de Update';

            require File::build_path(array("view","view.php"));
            die();
        }
    }

    public static function updated() {

            
            $updateArray = array(
                'id_commande' => $_GET['id_commande'],
                'date' => $_GET['date']
            );

            ModelCommande::update($updateArray);
            
            $c = ModelCommande::select($_GET['id_commande']); 
            
            $controller = 'commande';
            $view = 'updated';
            $pagetitle = 'Modification Effectuée';
        
            require File::build_path(array("view","view.php"));;
        } 


}



?>