<section>
    <h3>Détail de ma commande :</h3>
    <main id="main_panier">
      <table class='panier'>
<?php

  echo "
    <tr>
        <td>COMMANDE N° : " . $c->get('id_commande') . "</td>
        <td>FAIT LE :" . $c->get('date') . "</td>
        <td></td>
        <td></td>
        <td>" . $c->get('prix_total') . "</td>
    </tr>";

foreach($tab_listProduit as $key) {

    $quantite = $key->get('nb_produit');
    $produit = ModelProduit::select($key->get('produit_id'));


    $id_produitURL = rawurldecode($produit->get('id_produit'));
    $image = $produit->get("image");
    $nom = htmlspecialchars($produit->get('nom'));
    $categorie = htmlspecialchars($produit->get("categorie_id"));
    $prix = $produit->get("prix") * $quantite;
    

    echo "
    <tr>
        <td>
            <a href='?controller=produit&action=read&id_produit=$id_produitURL'>
                <img src='./public/images/produit/$image' alt='produit_image' height='50px'>
            </a>
        </td>
        <td>$nom</td>
        <td>$categorie</td>
        <td>$quantite </td>
        <td>$prix <strong>€</strong></td>
    </tr>";
}

if(Session::is_admin()) {
echo "
    <td>
      <a href='?controller=commande&action=delete&id_commande=" . $c->get('id_commande') . "'>
        Supprimer
      </a>
    </td>
    <td>
      <a href='?controller=commande&action=update&id_commande=" . $c->get('id_commande') . "'>
        Mettre à jour
      </a>
    </td>
";
}
?>
    </table>
  </main>
</section>