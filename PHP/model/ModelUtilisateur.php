<?php

class ModelUtilisateur extends Model {

    private $login;
    private $nom;
    private $prenom;
    private $nonce;
    private $email;
    private $mdp;
    
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
            $this->nonce = $data['nonce'];
            $this->email = $data['email'];
            $this->mdp = $data['mdp'];
        }
    }
}

