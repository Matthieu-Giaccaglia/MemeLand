<section>
    <h3>Liste des produits :</h3>
    <main id="main_panier">
        <?php

            if(sizeof($tab_produit)==0){
                echo "Aucun Article";
            } else {
                echo "<table class='panier'>
                            <tr>
                                <td>N° Produit</td>
                                <td>Image</td>
                                <td>Nom du produit</td>
                                <td>Categorie</td>
                                <td>Prix</td>
                                <td>Disponible</td>
                            </tr>";
                foreach ($tab_produit as $p) {
            
                    $id_produit = $p->get("id_produit");
                    $image = $p->get("image");
                    $nomHTML = htmlspecialchars($p->get("nom"));
                    $categorie = $p->get("categorie_id");
                    $prix = $p->get("prix");
                    if($p->get("disponible")) $disponible='OUI';
                    else $disponible='non';
                           
                    echo "
                                <tr>
                                    <td>$id_produit</td>
                                    <td>
                                        <a href='?controller=produit&action=read&id_produit=$id_produit'>
                                            <img src='./public/images/produit/$image' alt='produit_image' height='50px'>
                                        </a>
                                    </td>
                                    <td>$nomHTML</td>
                                    <td>$categorie</td>
                                    <td>$prix <strong>€</strong></td>
                                    <td>$disponible</td>
                                </tr>";
   
                }
            }
        ?>
    </main>
</section>