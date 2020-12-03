<?php

require_once File::build_path(array("model", "Model.php"));

class ModelProduit extends Model {

    private $idProduit;
    private $nom;
    private $description;
    private $idCategorie;
    private $prix;
    private $image;
    private $couleur;
    
    protected static $object = 'produit';
    protected static $primary = 'idProduit';

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
            $this->idProduit = $data['idProduit'];
            $this->nom = $data['nom'];
            $this->description = $data['description'];
            $this->idCategorie = $data['idCategorie'];
            $this->prix = $data['prix'];
            $this->image = $data['image'];
            $this->couleur = $data['couleur'];
        }
    }
}
