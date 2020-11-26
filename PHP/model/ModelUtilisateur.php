<?php

class ModelUtilisateur extends Model {

    private $login;
    private $nom;
    private $prenom;
    private $nonce;
    private $email;
    
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
    public function __construct($login, $nom, $prenom, $email) {
        if (!is_null($email)) $nonce = NULL;
        if (!is_null($login) && !is_null($nom) && !is_null($prenom) && is_null($nonce) && !is_null($email))         {
            $this->login = $login;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->nonce = $nonce;
            $this->email = $email;
        }
    }
