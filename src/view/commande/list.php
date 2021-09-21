	<section>
		<h3>Liste des commandes :</h3>
		<main id="main_panier">
	<?php
	if(!$tab_c){
	echo "<p>Vous n'avez pas de commandes</p>";
	} else {
	echo "<table class='panier'>
			<tbody>
				<tr>
					<td>N°Commande</td>
					<td>Date</d>
					<td>Prix Total</td>
				</tr>";
	foreach ($tab_c as $c) {
		
		$id_commandeURL = rawurlencode($c->get('id_commande'));
		$loginURL= rawurlencode($c->get("utilisateur_login"));
		$date = $c->get("date");
		$prixtotal = $c->get("prix_total");
		
		echo "
			<tr>
				<td>
				<a href='?controller=commande&action=maCommandeDetail&id_commande=$id_commandeURL&login=$loginURL'>
					$id_commandeURL
				</a>
				</td>
			<td>$date</td>
			<td>$prixtotal</td>
		</tr>";
	}
	echo "</tbody>
		<table>";
	}
	?>
			</tbody>
		</table>
		</main>
	</section>
