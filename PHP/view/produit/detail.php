<?php
if(!isset($p)){
    $p = ModelProduit::select($_GET['id_produit']);
}
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
    <section>
        <p> 
            <b>Produit $nomHTML ($descriptionHTML) (Couleur : $idCouleurHTML) (Catégorie : $idCategorieHTML) (Prix : $prixHTML)</b>  
            <img src="./public/images/produit/$imageHTML" alt="Walter" class="perso">
EOT;

if(Session::is_admin()) {
echo <<< EOT
            <a href="?controller=produit&action=update&id_produit=$idProduitURL">
                Mettre à jour
            </a>
            <a href="?controller=produit&action=delete&id_produit=$idProduitURL">
                Supprimer
            </a>
EOT;
}
?>
    <div class="button">
    <form method="get" action="">
        <input type="hidden" name="action" value="ajoutPanier">
        <input type="hidden" name="controller" value="utilisateur">
        <input type="hidden" name="id_produit" value="<?php echo $idProduitURL;?>">
        <input class="b_input" type="submit" value="Ajouter au panier" />
    </form>
    </div>
    </p>
</section>