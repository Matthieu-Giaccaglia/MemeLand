<?php
require_once File::build_path(array("config", "Conf.php"));

class ModelCommande extends Model {

    private $id_commande;
    private $utilisateur_login;
    private $date;
    
    protected static $object = 'commande';
    protected static $primary = 'id_commande';

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
            $this->utilisateur_login = $data['utilisateur_login'];
            $this->id_commande = $data['id_commande'];
            $this->date = $data['date'];
        }
    }

    
    public static function saveCommande($utilisateur_login, $date, $produit = array()) {
        try {
            echo '------------------------------------------------';

            $sql = "INSERT INTO p_commande (utilisateur_login, date) VALUES ('$utilisateur_login', '$date');";
            foreach ($produit as $cle => $value){
                
                $sql = $sql . "INSERT INTO p_liste_article(commande_id, produit_id) VALUES (LAST_INSERT_ID(), $value);";
            }
        
            $req_prep = Model::$pdo->prepare($sql);
            return $req_prep->execute();
  
           
        } catch (PDOException $e) {
            
            if ($e->errorInfo[1]==1062){
                return false;
            }else if (Conf::getDebug()) {
                var_dump($e);
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    private static function ajoutProduit($id_commande, $idProduit) {

        $sql = "INSERT INTO p_liste_article(commande_id, produit_id) VALUES ($id_commande, $idProduit);";
        Model::$pdo->prepare($sql);

    }

    
}

