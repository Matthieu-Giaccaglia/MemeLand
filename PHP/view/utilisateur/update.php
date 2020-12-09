<?php

    if($action == 'created') {

        $old = "";
        $reqMdp = "required";
        $createOrUpdate = 'Créer';
        $loginReadOrReq = 'required';

        $user = new ModelUtilisateur(array(
            'login' => "",
            'nom' => "",
            'prenom' => "",
            'email' => "",
            'nonce' => "",
            'mdp' => ""
        ));
      
    } else if($action == 'updated') {
        if(isset($_GET['login']))
            $user = ModelUtilisateur::select($_GET['login']);
        else if (isset($_POST['login']))
            $user = ModelUtilisateur::select($_POST['login']);

        $loginReadOrReq = 'readonly';
        $reqMdp = "";
        $old = "Ancien";
        $createOrUpdate = 'Mettre à jour';

    }

?>



<section>
    <div>
        <form method="post" action="./index.php?controller=utilisateur&action=<?php echo $action?>">
            <fieldset>
                <legend><?php echo $createOrUpdate ?> mon compte :</legend>
                <p>
                    <label for="login_id">Login</label> :
                    <input type="text" value="<?php echo $user->get('login'); ?>" name="login" id="id_user_id" <?php echo $loginReadOrReq?>>
                </p>
                <p>
                    <label for="nom_id">Nom</label> :
                    <input type="text" value="<?php echo $user->get('nom'); ?>" name="nom" id="nom_id" required>
                </p>
                <p>
                    <label for="prenom_id">Prenom</label> :
                    <input type="text" value="<?php echo $user->get('prenom'); ?>" name="prenom" id="prenom_id"  required>
                </p>
                <p>
                    <label for="email_id">Email</label> :
                    <input type="email" value="<?php echo $user->get('email'); ?>"name="email" id="email_id" <?php echo $loginReadOrReq?>>
                </p>
                <p>
                    <label for="mdp_id"><?php echo "$old "; ?>Mot de Passe :</label>
                    <input type="password" value="" name="mdp" id="mdp_id" <?php echo $reqMdp ?>>
                </p>
                <?php
                    if ($action == 'updated') {
                    echo "
                    <p>
                        <label for='mdp_new_id'>Nouveau Mot de Passe</label> :
                        <input type='password' value='' name='new_mdp' id='mdp_new_id'>
                    </p>";
                }
                ?>
                <p>
                    <label for="conf_mdp_id">Confirmation Mot de Passe :</label> :
                    <input type="password" value="" name="conf_mdp" id="conf_mdp_id" <?php echo $reqMdp ?>>
                </p>
                <?php
                if(Session::is_admin()) {
                    echo "
                    <p>
                        <input type='checkbox' value='' name='admin' id='admin_id'"; if($user->get('admin')) echo " checked>";
                    echo "<label for='disponible_id'>Admin</label>
                    </p>";
                }
                ?>
                <p>
                    <input class="b_input" type="submit" value="Envoyer" />
                </p>
            </fieldset> 
        </form>
    </div>
</section>