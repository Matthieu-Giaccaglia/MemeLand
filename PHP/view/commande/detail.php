<?php
if(!isset($c)){
    $c = ModelCommande::select($_GET['id_commande']);
}
//require_once File::build_path(array('produit', 'detail.php'));

$idCommandeHTML = htmlspecialchars($c->get("commande_id"));
$produitHTML = htmlspecialchars($c->get("produit_id"));
$nbproduitHTML = htmlspecialchars($c->get("nb_produit"));

$vidProduitURL = rawurlencode($c->get("id_produit"));
$image = $c->get("image");
$nom = $c->get("nom");
$categorie = $c->get("categorie_id");
$prix = $c->get("prix");

echo <<< EOT
    <section>
        <p> 
            Détail de la commande $idCommandeHTML : 
            <ul>
                <li><a href="?controller=produit&action=read&id_produit=$vidProduitURL"><img src="./public/images/produit/$image" alt="produit_image" class="perso">
                <table>
                  <tr>
                    <td>$nom</td>
                    <td>$categorie</td>
                    <td>$prix <strong>€</strong></td>
                  </tr>
                </table>  
              </a></li>
            </ul>
EOT;

if(Session::is_admin()) {
echo <<< EOT
            <a href="?controller=commande&action=update&id_commande=$idcommandeURL">
                Mettre à jour
            </a>
EOT;
}
?>
    <div class="button">
    <form method="get" action="">
        <input type="hidden" name="action" value="ajoutPanier">
        <input type="hidden" name="controller" value="utilisateur">
        <input type="hidden" name="id_commande" value="<?php echo $idcommandeURL;?>">
        <input class="b_input" type="submit" value="Ajouter au panier" />
    </form>
    </div>
    </p>
</section>