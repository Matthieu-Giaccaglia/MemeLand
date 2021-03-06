<?php

require_once File::build_path(array("model", "Model.php"));

class ModelProduit extends Model {

    private $id_produit;
    private $nom;
    private $description;
    private $categorie_id;
    private $prix;
    private $image;
    private $couleur;
    private $disponible;
    
    protected static $object = 'produit';
    protected static $primary = 'id_produit';

    // Getter générique
    public function get($nom_attribut) {
        if (property_exists($this, $nom_attribut))
            return $this->$nom_attribut;
        return false;
    }

    // Setter générique
    public function set($nom_attribut, $valeur) {
        if (property_exists($this, $nom_attribut))
            $this->$nom_attribut = $valeur;
        return false;
    }

    // un constructeur
    public function __construct($data = array()) {
        if (!empty($data)) {
            $this->id_produit = $data['id_produit'];
            $this->nom = $data['nom'];
            $this->description = $data['description'];
            $this->categorie_id = $data['categorie_id'];
            $this->prix = $data['prix'];
            $this->image = $data['image'];
            $this->couleur = $data['couleur'];
            $this->disponible = $data['disponible'];
        }
    }

    public static function selectCategorie($categorie_id) {
        try {
        
            $table_name = "p_" . static::$object;
            $class_name = 'Model' . ucfirst(static::$object);

            $sql = "SELECT id_produit, categorie_id, prix, nom, description, image, couleur, disponible 
                    FROM p_produit p
                    JOIN p_categorie c ON p.categorie_id = c.id_categorie 
                    WHERE categorie_id= '$categorie_id'
                    AND disponible=true";

            $req_prep = Model::$pdo->query($sql);
            $req_prep->execute();

            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            return $req_prep->fetchAll();
            // Attention, si il n'y a pas de résultats, on renvoie false
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }

    }

    public static function selectAllDispo() {
        try {
            $pdo = self::$pdo;
            $table_name = "p_" . static::$object;
            $class_name = 'Model' . ucfirst(static::$object);
            
            $sql = "SELECT * from $table_name
                    WHERE disponible=true";
            $rep = $pdo->query($sql);
            $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            return $rep->fetchAll();
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }
}
