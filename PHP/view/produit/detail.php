<?php
$idProduitHTML = htmlspecialchars($v->get($idProduit));
$nomHTML = htmlspecialchars($v->get($nom));
$descriptionHTML = htmlspecialchars($v->get($description));
$prixHTML = htmlspecialchars($v->get($prix));
$idCouleurHTML = htmlspecialchars($v->get($idCouleur));
$idCategorieHTML = htmlspecialchars($v->get($idCategorie));

$idProduitURL = rawurlencode($v->get($idProduit));
$nomURL = rawurlencode($v->get($nom));
$descriptionURL = rawurlencode($v->get($description));
$prixURL = rawurlencode($v->get($prix));
$idCouleurURL = rawurlencode($v->get($idCouleur));
$idCategorieURL = rawurlencode($v->get($idCategorie));
echo <<< EOT
    <p> 
        Produit $nomHTML ($descriptionHTML) (ID : $idProduitHTML) (Couleur : $idCouleurHTML) (Catégorie : $idCategorieHTML) (Prix : $prixHTML)  
        <a href="?action=update&idProduit=$idProduitURL&nom=$nomURL&description=$descriptionURL&idCouleur=$idCouleur&idCategorie=$idCategorie">
            Mettre à jour
        </a>
    </p>
EOT;
?>