<section>
    <h3>Liste des commandes :</h3>
    <main id="main_panier">
<?php
if(!$tab_c){
  echo "Vous n'avez pas de commandes";
} else {
  echo "<table class='panier'>
          <tbody>";
  foreach ($tab_c as $c) {
      
    $id_commande = $c->get('id_commande');
    $login = $c->get("utilisateur_login");
    $date = $c->get("date");
    $prixtotal = $c->get("prix_total");
    
    echo "
      <td>
        <tr>
          <a href='?controller=commande&action=maCommandeDetail&id_commande=$id_commande&login=$login'>
            $id_commande
          </a>
        </tr>
        <tr>
          $login
        </tr>
        <tr>
          $date
        </tr>
        <tr>
          $prixtotal
        </tr>
      </td>";
  }
  echo "</tbody>
      <table>";
}
?>
        </tbody>
      </table>
    </main>
</section>
