<?php
require_once File::build_path(array("config", "Conf.php"));

class ModelCommande extends Model {

    private $id_commande;
    private $utilisateur_login;
    private $date;
    private $prix_total;
    
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
            $this->prix_total = $data['prix_total'];
        }
    }

    
    public static function saveCommande($utilisateur_login, $date,$prixTot, $tab_produit) {
        try {

            $sql = "INSERT INTO p_commande (utilisateur_login, date, prix_total) VALUES (:tag_login, :tag_date, :tag_prix_tot);";
            foreach ($tab_produit as $cle => $value){
                
                $sql = $sql . "INSERT INTO p_listeArticle(commande_id, produit_id, nb_produit) 
                                VALUES (LAST_INSERT_ID(), $cle, $value);";
            }
            

            $values = array(
                'tag_login' => $utilisateur_login,
                'tag_date' => $date,
                'tag_prix_tot' => $prixTot
            );
        
            $req_prep = Model::$pdo->prepare($sql);
            return $req_prep->execute($values);
  
           
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

    public static function readCommande($id_utilisateur) {

        try {
            $table_name = "p_" . static::$object;
            $class_name = 'Model' . ucfirst(static::$object);
            $primary_key = static::$primary;
            $sql = "SELECT * from p_commande 
                    WHERE utilisateur_login=:tag_utilisateur";

            $values = array(
                "tag_utilisateur" => $id_utilisateur
            );
            
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($values);

            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $tab_results = $req_prep->fetchAll();
            
            if (empty($tab_results))
                return false;
            return $tab_results;
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    } 

    public static function readProduit($id_commande) {

        try {
            
            $sql = "SELECT id_produit, categorie_id, prix, nom, description, image,couleur 
                    FROM p_produit p
                    JOIN p_liste_article l ON p.id_produit=l.produit_id
                    JOIN p_commande c ON l.commande_id=c.id_commande
                    WHERE c.id_commande=:tag_commande";

            $values = array(
                "tag_commande" => $id_commande
            );
            
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($values);

            
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
            $tab_results = $req_prep->fetchAll();

            var_dump($tab_results);
            
            if (empty($tab_results))
                return false;
            return $tab_results;

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

