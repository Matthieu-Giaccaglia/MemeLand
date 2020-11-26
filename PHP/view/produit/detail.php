<?php
$immatHTML = htmlspecialchars($v->getImmatriculation());
$marqueHTML = htmlspecialchars($v->getMarque());
$couleurHTML = htmlspecialchars($v->getCouleur());
$immatURL = rawurlencode($v->getImmatriculation());
$marqueURL = rawurlencode($v->getMarque());
$couleurURL = rawurlencode($v->getCouleur());
echo <<< EOT
    <p> 
        Voiture $immatHTML de marque $marqueHTML (Couleur $couleurHTML)  
        <a href="?action=update&immatriculation=$immatURL&couleur=$couleurURL&marque=marqueURL">
            Mettre à jour
        </a>
    </p>
EOT;
?>