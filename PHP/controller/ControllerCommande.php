<?php
require_once File::build_path(array('model', 'ModelCommande.php'));
require_once File::build_path(array('lib', 'Security.php')); 
require_once File::build_path(array('lib', 'Session.php'));

class ControllerCommande {

    protected static $object = "commande";

    public static function mesCommandes() {

        if (isset($_SESSION['login'])) {

            $tab_commande = ModelCommande::readCommande($_SESSION['login']);
            $controller = self::$object;

            if(!$tab_commande) {
                //PAS DE COMMANDE
            
            } else {
                $view = 'list';
                $pagetitle = 'Mes Commandes';

            }

        } else {
            //PAS CONNECTE
        }

        require File::build_path(array("view","view.php"));
    }

    public static function maCommandeDetail($id_commande, $id_utilisateur){

        if(isset($_SESSION['login']) && $_SESSION['login'] == $id_utilisateur) {

            $tab_produit = ModelCommande::readProduit($id_commande);

            if(!$tab_produit){
                //PAS PRODUIT DANS COMMANDE
            } else {
                $view = 'detail';
                $pagetitle = 'Détail de ma Commande';
            }

        } else {
            //PAS CO
        }

        require File::build_path(array("view","view.php"));
    }
}



?>