<section>
    <h3>Liste des utilisateur :</h3>
    <main id="main_panier">
        <?php
            $tab_user = ModelUtilisateur::selectAll();
            if(sizeof($tab_user)==0){
                echo "Aucun Utilisateur! Même vous ! Bizarre...";
            } else {
                echo "<table class='panier'>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Login</th>
                                <th>Email</th>
                                <th>Admin</th>
                                <th>Valider</th>
                                <th></th>
                            </tr>";
                foreach ($tab_user as $u) {
            
                    $nomHTML = htmlspecialchars($u->get("nom"));
                    $prenomHTML = htmlspecialchars($u->get("prenom"));
                    $loginHTML = htmlspecialchars($u->get("login"));
                    $loginRaw = rawurlencode($u->get("login"));
                    $emailHTML = htmlspecialchars($u->get("email"));
                     
                    if($u->get("admin")) $admin='OUI';
                    else $admin='non';
                           
                    echo "
                                <tr>
                                    <td>$nomHTML</td>
                                    <td>$prenomHTML</td>
                                    <td><a href='?controller=utilisateur&action=update&login=$loginRaw'>$loginHTML</a></td>
                                    <td>$emailHTML</td>
                                    <td>$admin</td>
                                    ";
                    
                    if($u->get("nonce") == NULL)
                        echo "      <td>Validé</td>";
                    else
                        echo "      <td>Pas Validé</td>";
                                
                    echo "          <td><a href='?controller=utilisateur&action=delete&login=$loginRaw'>Supprimer</a></td>
                                </tr>";
                }
                echo "</table>";
            }
        ?>
    </main>
</section>