<?php
	$bdd = new PDO('mysql:host=localhost;dbname=deneuvillew;charset=utf8', 'root', '');

	   if(isset($_GET['deleted']) AND !empty($_GET['deleted'])) {
	      $supprime = (int) $_GET['deleted'];
	      $req = $bdd->prepare('DELETE FROM p_produit WHERE id_produit = ?');
	      $req->execute(array($supprime));
	   }
	$p_produit = $bdd->query('SELECT * FROM p_produit ORDER BY id_produit');
	?>
	<!DOCTYPE html>
	<html>
	<head>
	   <meta charset="utf-8" />
	   <title>Administration</title>
	</head>
	<body>
	   <ul>
	      <?php while($p = $p_produit->fetch()) { ?>
	      <li><?= $p['id_produit'] ?> : <?= $p['nom'] ?> - <a href="deleted.php?deleted=<?= $p['id_produit'] ?>">Supprimer</a></li>
	      <?php } ?>
	   </ul>
	</body>
	</html>