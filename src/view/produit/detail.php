<?php
if(!isset($p)){
    $p = ModelProduit::select($_GET['id_produit']);
}
$nomHTML = htmlspecialchars($p->get("nom"));
$descriptionHTML = htmlspecialchars($p->get("description"));
$prixHTML = htmlspecialchars($p->get("prix"));
$idCouleurHTML = htmlspecialchars($p->get("couleur"));
$idCategorieHTML = htmlspecialchars($p->get("categorie_id"));
$image = $p->get("image");

$idProduitURL = rawurlencode($p->get("id_produit"));

echo <<< EOT
    <section>
        <p> 
            <b>Produit $nomHTML ($descriptionHTML) (Couleur : $idCouleurHTML) (Catégorie : $idCategorieHTML) (Prix : $prixHTML)</b>  
            <img src="./public/images/produit/$image" alt="Walter" class="perso">
EOT;

if(Session::is_admin()) {
echo <<< EOT
            <div class='button'>
                <form method='get' action=''>
                    <input type='hidden' name='action' value='update'>
                    <input type='hidden' name='controller' value='produit'>
                    <input type='hidden' name='id_produit' value='$idProduitURL'>
                    <input class='b_input' type='submit' value='Mettre à jour' />
                </form>
            </div>
            <div class='button'>
                <form method='get' action=''>
                    <input type='hidden' name='action' value='deleteConf'>
                    <input type='hidden' name='controller' value='produit'>
                    <input type='hidden' name='id_produit' value='$idProduitURL'>
                    <input class='b_input' type='submit' value='Supprimer' />
                </form>
            </div>
EOT;
}
?>
    <div class='button'>
    <form method='get' action="">
        <input type='hidden' name='action' value='ajoutPanier'>
        <input type='hidden' name='controller' value='utilisateur'>
        <input type='hidden' name='id_produit' value='<?php echo $idProduitURL;?>''>
        <input class='b_input' type='submit' value='Ajouter au panier' />
    </form>
    </div>
    </p>
</section>