<?php

require_once File::build_path(array('model', 'ModelProduit.php')); // chargement du modèle
require_once File::build_path(array('lib', 'Session.php'));
require_once File::build_path(array('lib', 'Security.php'));

class ControllerProduit {

    protected static $object = 'produit';

    public static function readAll() {
        $tab_p = ModelProduit::selectAllDispo();     //appel au modèle pour gerer la BD
        $controller = self::$object;
        $view = "list";
        $pagetitle = "Tous les produits";
        require File::build_path(array("view", "view.php"));
    }

    public static function readCategorie() {

        if(!is_null(myGet('categorie_id'))) {

            $tab_p = ModelProduit::selectCategorie($_GET['categorie_id']);

            if($tab_p) {
                $controller = 'produit';
                $view = "list";
                $pagetitle = "Tous les " . $_GET['categorie_id'] . "s";
                require File::build_path(array("view", "view.php"));
                return;
            } else {
                $erreurType = 'Catégorie non existante';
                self::erreur('list', 'Tous nos produits', $erreurType);
                return; 
            }
        } else {
            $erreurType = 'Catégorie non sélectionnée';
            self::erreur('list', 'Tous nos produits', $erreurType);
            return;
        }
    }

    public static function read() {
        if(!is_null(myGet('id_produit'))) {
            $p = ModelProduit::select($_GET["id_produit"]);
            if ($p){
                $controller = self::$object;
                $view = 'detail';
                $pagetitle = 'Détails du produit';
                require File::build_path(array("view","view.php"));
                return;

            } else {
                $erreurType = 'Produit non disponible';
                self::erreur('list', 'Tous nos produits', $erreurType);
                return;
            }
        } else {
            $erreurType = 'Aucun produit sélectionné';
            self::erreur('list', 'Tous nos produits', $erreurType);
            return;
        }
    }

    public static function create() {
        if(Session::is_admin()){
            $controller = 'produit';
            $view = 'update';
            $pagetitle = 'Créer un produit';
            $action = "created";
            require File::build_path(array("view","view.php"));
            return;
        } else {
            self::readAll();
            return;
        }
            
    }

    public static function created() {
        if(Session::is_admin()){
            if (!is_null('nom') && !is_null('description') && !is_null('prix') 
                && !is_null('categorie_id') && !is_null('couleur')) {
            
                $nameFile = self::nameUploadFile();

                if($nameFile != 0 || $nameFile != -1 && $nameFile != -2) {
                    
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
                        $tab_p = ModelProduit::selectAll();
                        $controller = 'admin';
                        $view = "created";
                        $pagetitle = "Produit crée";
                        require File::build_path(array('view', 'view.php'));
                        return;
                    } else {
                        $typeErreur = "Erreur de sauvegarde. Si vous êtes uniquement administateur, veuillez contacter votre supérieur.";
                        ControllerSite::erreur('equipe', "L'Équipe", $typeErreur);
                        return;
                    }

                } else if($nameFile == 0) {
                    $controller = self::$object;
                    $view = 'erreurExtension';
                    $pagetitle = 'Créer un produit';
                    $action = "created";
                    require File::build_path(array("view", "view.php"));
                    return;
                } else if ($nameFile == -1) {
                    $typeErreur = "Erreur d'upload. Si vous êtes uniquement administateur, veuillez contacter votre supérieur.";
                    ControllerSite::erreur('equipe', "L'Équipe", $typeErreur);
                    return;
                } else {
                    $typeErreur = "Image vide.";
                    ControllerSite::erreur('equipe', "L'Équipe", $typeErreur);
                    return; 
                }
            } else {
                $typeErreur = "Tous les champs n'ont pas été remplis.";
                ControllerAdmin::erreur('listAllProduct', 'Admin: Tous les produits', $typeErreur);
                return; 
            }
        } else {
            self::readAll();
            return;
        }
    }

    public static function delete() {
        if(Session::is_admin()){

            if(!is_null(myGet('id_produit'))) {
                $view = "deleted";
                $pagetitle = "Delete";

                
                $idProduit = $_GET['id_produit'];
                $delete_successful = ModelProduit::delete($_GET['id_produit']);
                
                if ($delete_successful) {
                    $tab_p = ModelProduit::selectAll();
                    $controller = 'admin';
                    $view = "deleted";
                    $pagetitle = "Produit supprimée";
                    require File::build_path(array("view","view.php"));
                    return; 
                } else {
                    $typeErreur = "La suppression s'est mal passée. Si vous êtes uniquement administateur, veuillez contacter votre supérieur.";
                    ControllerAdmin::erreur('listAllProduct', 'Admin: Tous les produits', $typeErreur);
                    return; 
                }
            } else {
                $typeErreur = 'Aucun produit sélectionnée.';
                ControllerAdmin::erreur('listAllProduct', 'Admin: Tous les produits', $typeErreur);
                return; 
            }
        } else {
            self::readAll();
            return;
        }
    }

    public static function update() {
        if(Session::is_admin()){
            if(!is_null(myGet('id_produit'))) {
                $produitUpdate = myGet("id_produit");
    
                $produit = ModelProduit::select($produitUpdate);
                
                if ($produit) {
                    $controller = self::$object;
                    $view = 'update';
                    $pagetitle = 'Modifier un produit';                    
                    $action = "updated";
                
                    require File::build_path(array("view","view.php"));
                } else {
                    $typeErreur = 'Problème de sauvegarde. ';
                    ControllerAdmin::erreur('listAllProduct', 'Admin: Tous les produits', $typeErreur);
                    return; 
                }
            } else {
                $typeErreur = 'Aucun produit sélectionnée. Si vous êtes uniquement administateur, veuillez contacter votre supérieur.';
                ControllerAdmin::erreur('listAllProduct', 'Admin: Tous les produits', $typeErreur);
                return; 
            }
        }else{
            self::readAll();
            return;
        }
    }

    public static function updated() {
        if(Session::is_admin()){
            if (!is_null('id_produit') && !is_null('nom') && !is_null('description') && !is_null('prix') 
                && !is_null('categorie_id') && !is_null('couleur')) {
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

                if($nameFile != 0 && $nameFile != -1 && $nameFile != -2){
                    $updateArray['image'] = $nameFile;
                } else if($nameFile == 0) {
                    $controller = self::$object;
                    $view = 'erreurExtension';
                    $pagetitle = 'Créer un produit';
                    $action = "updated";
                    require File::build_path(array("view", "view.php"));
                    return;
                } else if($nameFile == -1) {
                    $typeErreur = "Erreur d'upload. Si vous êtes uniquement administateur, veuillez contacter votre supérieur.";
                    ControllerSite::erreur('equipe', "L'Équipe", $typeErreur);
                    return;
                }

                ModelProduit::update($updateArray);
                
                $p = ModelProduit::select($_POST["id_produit"]); 
                
                $controller = 'produit';
                $view = 'updated';
                $pagetitle = 'Modification Effectuée';
                require File::build_path(array("view", "view.php"));
            } else {
                $typeErreur = "Tous les champs n'ont pas été remplis. Si vous êtes uniquement administateur, veuillez contacter votre supérieur.";
                ControllerAdmin::erreur('listAllProduct', 'Admin: Tous les produits', $typeErreur);
                return; 
            }
        } else {
            self::readAll();
            return;
        }
    } 


    private static function nameUploadFile(){
        if (is_uploaded_file($_FILES['monFichier']['tmp_name'])) {

            $nameOrigine = $_FILES['monFichier']['name'];
            $elementChemin = pathinfo($nameOrigine);
            $extensionFichier = $elementChemin['extension'];
            $extensionAutorisée = array('jpeg', 'jpg', 'png');

            if(!(in_array($extensionFichier, $extensionAutorisée))){
                //Mauvaise Extension
                return 0;
            } else {

                $repertoireDest = File::build_path(array('public','images','produit')) . "/";
                $newName = Security::generateRandomHex() . "." . $extensionFichier;

                if (move_uploaded_file($_FILES['monFichier']['tmp_name'], $repertoireDest.$newName)) {
                    return $newName;
                } else {
                    //impossible UPLOAD
                    return -1;
                }
            }
        } else {
            //Empty $_FILES
            return -2;
        } 
    }

    public static function erreur($afterView,$titlepage,$messageErreur) {
        $controller = self::$object;
        $view = 'erreur';
        $viewAfter = $afterView;
        $tab_p = ModelProduit::selectAllDispo();
        $typeErreur = $messageErreur;
        $pagetitle = $titlepage;
        require File::build_path(array("view","view.php"));
    }

}
