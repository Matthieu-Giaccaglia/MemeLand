<?php
require_once File::build_path(array("config", "Conf.php"));

class ModelListeArticle extends Model {

    private $commande_id;
    private $produit_id;
    private $nb_produit;
    
    protected static $object = 'listeArticle';
    protected static $primary = 'commande_id';

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
        //if (!is_null($data['email'])) $nonce = NULL;
        if (!empty($data)) {
            $this->commande_id = $data['commande_id'];
            $this->produit_id = $data['produit_id'];
            $this->nb_produit = $data['nb_produit'];
        }
    }

    public static function selectAllProduit($commande_id) {
        try {
            $pdo = self::$pdo;
            $table_name = "p_" . static::$object;
            $class_name = 'Model' . ucfirst(static::$object);
            
            $sql = "SELECT * from $table_name
                    WHERE commande_id=$commande_id";
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