<section>
    <h3>Panier :</h3>
    <main id="main_panier">

        <?php

            $prixTot = 0;
            if(sizeof($tab_panier)==0){
                echo "<p>Votre panier est vide</p>";
            } else {
                echo "<table class='panier'>";
                foreach ($tab_panier as $key => $value) {
                    $p = ModelProduit::select($key);
            
                    $vidProduitURL = rawurlencode($p->get("id_produit"));
                    $image = $p->get("image");
                    $nom = $p->get("nom");
                    $categorie = $p->get("categorie_id");
                    $prix = $p->get("prix")*$value;
                    
                    $prixTot = $prixTot + $prix;
            
                    echo "
                                <tr>
                                    <td>
                                        <a href='?controller=produit&action=read&id_produit=$vidProduitURL'>
                                            <img src='./public/images/produit/$image' alt='produit_image' height='50px'>
                                        </a>
                                    </td>
                                    <td>$nom</td>
                                    <td>$categorie</td>
                                    <td>$prix <strong>€</strong></td>
                                    <td>
                                        <form method='get' action=''>
                                            <input type='hidden' name='controller' value='$controller'>
                                            <input type='hidden' name='action' value='enleverPanier'>
                                            <input type='hidden' name='id_produit' value='$key'>
                                            <input class='b_input' type='submit' value='-'>
                                        </form>
                                    </td>
                                    <td>$value</td> 
                                    <td>
                                        <form method='get' action=''>
                                            <input type='hidden' name='controller' value='$controller'>
                                            <input type='hidden' name='action' value='ajoutPanier'>
                                            <input type='hidden' name='id_produit' value='$key'>
                                            <input class='b_input' type='submit' value='+'>
                                        </form>
                                    </td>
                                </tr>";
   
                }
                echo "
                    </table>
                    <div class='button'>
                        <form action='' method='get'>
                            <input type='hidden' name='controller' value='utilisateur'>
                            <p> Prix total : $prixTot</p> 
                            <button class='b_input' type='submit' name='action' value='payer'>Payer</button>
                        </form>
                    </div>";
            }
        ?>
    </main>
</section>