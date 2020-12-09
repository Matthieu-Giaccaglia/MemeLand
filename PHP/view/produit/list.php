<aside>
          <div class="menu_s">
            <a href="?controller=produit&action=readCategorie&categorie_id=pull"><div class="smenu_s" onclick="location.href='?controller=produit&action=readCategorie&categorie_id=pull';"><h1>Pulls</a>
            </div>
            <a href="?controller=produit&action=readCategorie&categorie_id=shirt"><div class="smenu_s" onclick="location.href='?controller=produit&action=readCategorie&categorie_id=shirt';"><h1>T-shirts</a>
            </div>
            <a href="?controller=produit&action=readCategorie&categorie_id=chaussure"><div class="smenu_s" onclick="location.href='?controller=produit&action=readCategorie&categorie_id=chaussure';"><h1>Chaussures</a>
            </div>
            <a href="?controller=produit&action=readCategorie&categorie_id=pins"><div class="smenu_s" onclick="location.href='?controller=produit&action=readCategorie&categorie_id=pins';"><h1>Pins</a></h1>
            </div><!--animation pour hover, agrandit la taille de la boite et rapetissit les autres-->
          </div>
</aside>

<section>
    <h3>Liste des produits :</h3>
    <main>
      <ul>

<?php
foreach ($tab_p as $p) {
    
    
    $vidProduitURL = rawurlencode($p->get("id_produit"));
    $image = $p->get("image");
    $nomHTML = htmlspecialchars($p->get("nom"));
    $categorieHTML = htmlspecialchars($p->get("categorie_id"));
    $prix = $p->get("prix");

    
    echo "
        <li> 
            <a href='?controller=produit&action=read&id_produit=$vidProduitURL'><img src='./public/images/produit/$image' alt='produit_image' class='perso'>
              <table>
                <tr>
                  <td>$nomHTML</td>
                  <td>$categorieHTML</td>
                  <td>$prix <strong>€</strong></td>
                </tr>
              </table>  
            </a>
        </li>";
}
?>
      </ul>
    </main>
</section>