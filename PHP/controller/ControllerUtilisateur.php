<?php

class ControllerUtilisateur{
    
    protected static $object = "utilisateur";

    public static function panier(){
        $controller = self::$object;
        $view = "panier";
        $pagetitle = "Panier";

        $tab_panier = unserialize($_COOKIE["TestCookie"]);

        require File::build_path(array("view","view.php"));
    }

    public static function ajoutPanier() {
        
        $tab_panier = unserialize($_COOKIE["TestCookie"]);
        $id_produit = $_GET["id_produit"];
        array_push($tab_panier, $id_produit);
        setcookie("TestCookie", serialize($tab_panier), 120);

        $controller = self::$object;
        $view = "ajoutPanier";
        $pagetitle = "Détails du produit";

        $p = ModelProduit::select($id_produit);

        require File::build_path(array("view","view.php"));
    }
}