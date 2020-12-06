<section>
    <h3>Liste des produits Util :</h3>
    <main>
        <ul>

<?php
foreach ($tab_panier as $prod_p) {
    $p = ModelProduit::select($prod_p);
    
    $vidProduitURL = rawurlencode($p->get("id_produit"));
    $image = $p->get("image");
    $nom = $p->get("nom");
    $categorie = $p->get("categorie_id");
    $prix = $p->get("prix");
    
    echo <<< EOT
        <li> 
            <a href="?controller=produit&action=read&id_produit=$vidProduitURL"><img src="./public/images/produit/$image" alt="produit_image">
                <table>
                    <tr>
                    <td>$nom</td>
                    <td>$categorie</td>
                    <td>$prix <strong>€</strong></td>
                    </tr>
                </table>
            </a>
        </li>
EOT;
}
?>
        </ul>
    </main>
    <div class="button">
        <input class="b_input" type="submit" value="Payer"/>
    </div>
</section>