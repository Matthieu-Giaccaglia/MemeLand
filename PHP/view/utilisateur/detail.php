<?php

$loginHTML = htmlspecialchars($u->get("login"));
$nomHTML = htmlspecialchars($u->get("nom"));
$prenomHTML = htmlspecialchars($u->get("prenom"));
$emailHTML = htmlspecialchars($u->get("email"));

$loginURL = rawurlencode($u->get("login"));
$nomURL = rawurlencode($u->get("nom"));
$prenomURL = rawurlencode($u->get("prenom"));
$emailURL = rawurlencode($u->get("email"));


echo <<< EOT
<section>
    <p> 
        <ul>
            <li>login : $loginHTML</li>
            <li>nom : $nomHTML</li>
            <li>prenom : $prenomHTML</li>
            <li>email : $emailHTML</li>
    </p>
</section>
EOT;
?>
<div class="button">
    <form method="get" action="">
        <input type="hidden" name="action" value="deconnect">
        <input type="hidden" name="controller" value="utilisateur">
        <input class="b_input" type="submit" value="Se déconnecter" />
    </form>
</div>