<section>
    <h3>Liste des utilisateur :</h3>
    <main id="main_panier">
        <?php

            if(sizeof($tab_user)==0){
                echo "Aucun Utilisateur!Même vous ! Bizarre...";
            } else {
                echo "<table class='panier'>
                            <tr>
                                <td>Nom</td>
                                <td>Prénom</td>
                                <td>Login</td>
                                <td>Email</td>
                                <td>Admin</td>
                            </tr>";
                foreach ($tab_user as $u) {
            
                    $nom = htmlspecialchars($u->get("nom"));
                    $prenom = htmlspecialchars($u->get("nom"));
                    $loginHTML = htmlspecialchars($u->get("login"));
                    $loginRaw = rawurlencode($u->get("login"));
                    $email = htmlspecialchars($u->get("email"));
                     
                    if($u->get("admin")) $admin='OUI';
                    else $admin='non';
                           
                    echo "
                                <tr>
                                    <td>$nom</td>
                                    <td>$prenom</td>
                                    <td><a href='?controller=utilisateur&action=update&login=$loginRaw'>$loginHTML</a></td>
                                    <td>$email</td>
                                    <td>$admin</td>
                                </tr>";
   
                }
            }
        ?>
    </main>
</section>