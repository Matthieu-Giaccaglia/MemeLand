<?php

require_once File::build_path(array("model", "Model.php"));

class ModelProduit extends Model {

    private $idProduit;
    private $nom;
    private $description;
    private $idCategorie;
    private $idCouleur;
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
    public function __construct($idP, $nomP, $descriptionP, $idCategorieP, $idCouleurP) {
        if (!is_null($idP) && !is_null($nomP) && !is_null($descriptionP) && !is_null($idCategorieP) &&
        !is_null($idCouleurP)) {
            $this->idProduit = $idP;
            $this->nom = $nomP;
            $this->description = $descriptionP;
            $this->idCategorie = $idCategorieP;
            $this->idCouleur = $idCouleurP;
        }
    }
}
