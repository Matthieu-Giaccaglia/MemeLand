<?php

class ModelUtilisateur extends Model {

    private $login;
    private $nom;
    private $prenom;
    private $nonce;
    private $email;
    private $mdp;
    private $admin;
    
    protected static $object = 'utilisateur';
    protected static $primary = 'login';

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
            $this->login = $data['login'];
            $this->nom = $data['nom'];
            $this->prenom = $data['prenom'];
            $this->nonce = '';
            $this->email = $data['email'];
            $this->mdp = $data['mdp'];
            $this->admin = '';
        }
    }

    public static function checkPassword($login, $mot_de_passe_hache){

        try {
            $table_name = "p_" . static::$object;
            $class_name = 'Model' . ucfirst(static::$object);
            $primary_key = static::$primary;
            $sql = "SELECT * from $table_name WHERE $primary_key=:primary AND mdp='$mot_de_passe_hache'";
            
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "primary" => $login
            );
            // On donne les valeurs et on exécute la requête	 
            $req_prep->execute($values);

            // On récupère les résultats comme précédemment
            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $tab_results = $req_prep->fetchAll();
            // Attention, si il n'y a pas de résultats, on renvoie false
            if (empty($tab_results)) 
                return false;
            else
                return $tab_results[0];
            
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

