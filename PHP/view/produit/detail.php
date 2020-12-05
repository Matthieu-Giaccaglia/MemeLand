<?php
$nomHTML = htmlspecialchars($p->get("nom"));
$descriptionHTML = htmlspecialchars($p->get("description"));
$prixHTML = htmlspecialchars($p->get("prix"));
$idCouleurHTML = htmlspecialchars($p->get("couleur"));
$idCategorieHTML = htmlspecialchars($p->get("categorie_id"));
$imageHTML = htmlspecialchars($p->get("image"));

$idProduitURL = rawurlencode($p->get("id_produit"));
$nomURL = rawurlencode($p->get("nom"));
$descriptionURL = rawurlencode($p->get("description"));
$prixURL = rawurlencode($p->get("prix"));
$idCouleurURL = rawurlencode($p->get("couleur"));
$idCategorieURL = rawurlencode($p->get("categorie_id"));
echo <<< EOT
    <p> 
        <b>Produit $nomHTML ($descriptionHTML) (Couleur : $idCouleurHTML) (Catégorie : $idCategorieHTML) (Prix : $prixHTML)</b>  
        <img src="./public/images/produit/$imageHTML" alt="Walter" class="perso">
        <a href="?controller=produit&action=update&id_produit=$idProduitURL">
            Mettre à jour
        </a>
    </p>
EOT;
?>