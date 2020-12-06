<section>
    <h3>Panier :</h3>
    <main>

<?php
$prixTot = 0;
if(sizeof($tab_panier)==0){
    echo "Votre panier est vide";
}else{
    echo "<ul>";
    foreach ($tab_panier as $prod_p) {
        $p = ModelProduit::select($prod_p);
        
        $vidProduitURL = rawurlencode($p->get("id_produit"));
        $image = $p->get("image");
        $nom = $p->get("nom");
        $categorie = $p->get("categorie_id");
        $prix = $p->get("prix");
        
        $prixTot = $prixTot + $p->get("prix");

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
    echo "</ul>";
}
?>
    </main>
    <div class="button">
        <form action="./index.php" method="get">
            <?php if($prixTot != 0) echo "<p> Prix total : $prixTot</p>";?>
            <input type="hidden" name="controller" value="utilisateur">
            <button class="b_input" type="submit" name="action" value="payer">Payer</payer>
        </form>
    </div>
</section>