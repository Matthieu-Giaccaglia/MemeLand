<section>
    <div>
        <form method="get" action="./index.php">
            <fieldset>
                <legend>Mon formulaire :</legend>
                <p>
                    <label for="login_id">Login</label> :
                    <input type="text" value="<?php echo $user->get('login'); ?>" name="login" id="id_user_id" <?php echo $readOrReq ?>>
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
                    <label for="nonce_id">Nonce</label> :
                    <input type="text" value="<?php echo $user->get('nonce'); ?>" name="nonce" id="nonce_id"  required>
                </p>
                <p>
                    <label for="email_id">Email</label> :
                    <input type="text" value="<?php echo $user->get('email'); ?>"name="email" id="email_id" >
                </p>
                <p>
                    <label for="mdp_id">Mot de Passe</label> :
                    <input type="text" value="<?php echo $user->get('mdp'); ?>"name="mdp" id="mdp_id"  required>
                </p>
                <input type='hidden' name='action' value='<?php echo $action; ?>'>
                <input type='hidden' name='controller' value='<?php echo $controller; ?>'>
                <p>
                    <input type="submit" value="Envoyer" />
                </p>
            </fieldset> 
        </form>
    </div>
</section>