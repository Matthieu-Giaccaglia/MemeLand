<?php

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

        $p = ModelProduit::select($id_produit);

        require File::build_path(array("view","view.php"));
    }
}