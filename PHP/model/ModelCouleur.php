<?php

require_once File::build_path(array("model", "Model.php"));

class ModelCouleur extends Model {
    private $idCouleur;
    private $nom;
    private $image;

    protected static $object = 'couleur';
    protected static $primary = '$idCouleur';
    
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

    public function __construct($idC, $nomC, $imageC) {
        if (!is_null($idC) && !is_null($nomC) && !is_null($imageC) {
            $this->idProduit = $idC;
            $this->nom = $nomC;
            $this->description = $imageC; 
        }
    }
}
