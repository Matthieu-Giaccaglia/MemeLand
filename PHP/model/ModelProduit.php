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
            $this->id_produit = $data['id_produit'];
            $this->nom = $data['nom'];
            $this->description = $data['description'];
            $this->categorie_id = $data['categorie_id'];
            $this->prix = $data['prix'];
            $this->image = $data['image'];
            $this->couleur = $data['couleur'];
        }
    }
}
