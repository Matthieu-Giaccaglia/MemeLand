<?php

require_once File::build_path(array('model', 'ModelProduit.php')); // chargement du modèle
require_once File::build_path(array('lib', 'Session.php'));
require_once File::build_path(array('lib', 'Security.php'));

class ControllerProduit {

    protected static $object = 'produit';

    public static function readAll() {
        $tab_p = ModelProduit::selectAllDispo();     //appel au modèle pour gerer la BD
        $controller = 'produit';
        $view = "list";
        $pagetitle = "Tous les produits";


        require File::build_path(array("view", "view.php"));
    }

    public static function readCategorie() {
        $tab_p = ModelProduit::selectCategorie($_GET['categorie_id']);
        

        $controller = 'produit';
        $view = "list";
        $pagetitle = "Tous les " . $_GET['categorie_id'] . "s";


        require File::build_path(array("view", "view.php"));
    }

    public static function read() {
        $p = ModelProduit::select($_GET["id_produit"]);
        if ($p == false){
            $controller = 'produit';
            $view = 'errorProduit';
            $pagetitle = 'Erreur';
            
        } else {
            $controller = 'produit';
            $view = 'detail';
            $pagetitle = 'Détails du produit';
    
        
            
        }
        require File::build_path(array("view","view.php"));
    }

    public static function create() {
        if(Session::is_admin()){
            $controller = 'produit';
            $view = 'update';
            $pagetitle = 'Créer un produit';
            
            $produit = new ModelProduit(array(
                'id_produit' => "",
                'nom' => "",
                'description' => "",
                'prix' => "",
                'categorie_id' => "",
                'couleur' => "",
                'disponible' =>"",
                'image' => ""
            ));
            
            $action = "created";
            $required = true;
        }else{
            $controller = 'produit';
            $view = 'error';
            $pagetitle = 'Simple Utilisateur';
        }
        
        require File::build_path(array("view","view.php"));
    }

    public static function created() {
        $pagetitle = "Gestion des produits";
        $controller = 'produit';
        $view = 'created';


        $nameFile = self::nameUploadFile();

        if($nameFile) {
            
            $save = ModelProduit::save(array(
                'nom' => $_POST['nom'],
                'description' => $_POST['description'],
                'prix' => $_POST['prix'],
                'categorie_id' => $_POST['categorie_id'],
                'couleur' => $_POST['couleur'],
                'disponible' => isset($_POST['disponible']),
                'image' => $nameFile
            ));

            if ($save) {
                self::readAll();
            } else {
                //ERROR
                $view = 'errorProduit';
                $pagetitle = 'Erreur';
            }
        } else {
            //ERROR_UPLOAD
        }
        require File::build_path(array("view", "view.php"));
    }

    public static function error() {
        $view = "error";
        $pagetitle = "error";
        require File::build_path(array("view", "view.php"));
    }

    public static function delete() {
        $view = "deleted";
        $pagetitle = "Delete";

        
        $idProduit = $_GET['id_produit'];
        $delete_successful = ModelProduit::delete($_GET['id_produit']);
        
        if ($delete_successful) {
            $tab_p = ModelProduit::selectAll();

            $controller = self::$object;
            $view = "deleted";
            $pagetitle = "Produit supprimée";
         } else {
            $controller = self::$object;
            $view = "error";
        }
        
        require File::build_path(array("view", "view.php"));
    }

    public static function update() {
        $produitUpdate = $_GET["id_produit"];
        echo $produitUpdate;
        $produit = ModelProduit::select($produitUpdate);
        
        if ($produit) {
            $controller = self::$object;
            $view = 'update';
            $pagetitle = 'Modifier un produit';
            
            $action = "updated";
            $required = false;
        
            require File::build_path(array("view","view.php"));
        } else {
            $controller = 'produit';
            $view = 'errorDelete';
            $pagetitle = 'Erreur de suppression';

            require File::build_path(array("view","view.php"));
            die();
        }
    }

    public static function updated() {

            
            $updateArray = array(
                'id_produit' => $_POST["id_produit"],
                'nom' => $_POST['nom'],
                'description' => $_POST['description'],
                'prix' => $_POST['prix'],
                'categorie_id' => $_POST['categorie_id'],
                'disponible' => isset($_POST['disponible']),
                'couleur' => $_POST['couleur']
            );

            $nameFile = self::nameUploadFile();

            if($nameFile)
                $updateArray['image'] = $nameFile;

            ModelProduit::update($updateArray);
            
            $p = ModelProduit::select($_POST["id_produit"]); 
            
            $controller = 'produit';
            $view = 'updated';
            $pagetitle = 'Modification Effectuée';
        
            require File::build_path(array("view","view.php"));;
        } 


        private static function nameUploadFile(){

            if (is_uploaded_file($_FILES['monFichier']['tmp_name'])) {

                $nameOrigine = $_FILES['monFichier']['name'];
                $elementChemin = pathinfo($nameOrigine);
                $extensionFichier = $elementChemin['extension'];
                $extensionAutorisée = array('jpeg', 'jpg', 'png');

                if(!(in_array($extensionFichier, $extensionAutorisée)))
                    echo 'Wrong extension';

                else {

                    $repertoireDest = File::build_path(array('public','images','produit')) . "/";
                    $newName = Security::generateRandomHex() . "." . $extensionFichier;

                    if (!move_uploaded_file($_FILES['monFichier']['tmp_name'], $repertoireDest.$newName)) {
                        return false;
                    } else {
                        return $newName;
                    }
                }
            } else {
                return false;
            } 
        }

        public static function erreurProduit() {

            $controller = self::$object;
            $view = 'erreurProduitExist';
            $pagetitle = 'Tous nos articles';
            $tab_p = ModelProduit::selectAllDispo();

            require File::build_path(array("view","view.php"));
        }
    

    }
