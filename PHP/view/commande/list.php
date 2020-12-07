<aside>
          <div class="menu_s">
            <a href="?controller=commande&action=read&id_commande=?"><div class="smenu_s" onclick="location.href='?controller=commande&action=readAll&categorie_id=pull';"><h1>Pulls</a>
            </div>
            <a href=""><div class="smenu_s" onclick="location.href='';"><h1>T-shirts</a>
            </div>
            <a href=""><div class="smenu_s" onclick="location.href='';"><h1>Chaussures</a>
            </div>
            <a href="?controller=produit&action=readCategorie&categorie_id=pins"><div class="smenu_s" onclick="location.href='?controller=produit&action=readCategorie&categorie_id=pins';"><h1>Pins</a></h1>
            </div><!--animation pour hover, agrandit la taille de la boite et rapetissit les autres-->
          </div>
</aside>

<section>
    <h3>Liste des commandes :</h3>
    <main>
      <ul>

<?php
foreach ($tab_c as $c) {
    
    $idcommancde = $c->get("id_commande");
    $userlogin = $c->get("utilisateur_login");
    $date = $c->get("date");
    $prixtotral = $c->get("prix_total");
    
    echo <<< EOT
        <li>
            <a href="?controller=commande&action=mesCommandes>Commande numéro : $idcommande</a> passé le $date montant total de la commande : $prixtotal <a href="?controller=commande&action=maCommandeDetail($idcommande, $userlogin)>(voir le détail)</a>
        </li>
EOT;
}
?>
      </ul>
    </main>
</section>
