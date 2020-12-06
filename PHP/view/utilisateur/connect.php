<section>
    <div>
        <form method="get" action="./index.php">
            <fieldset>
                <legend>Connexion :</legend>
                <p>
                    <label for="login_id">Login</label> :
                    <input type="text" name="login" id="id_user_id" required>
                </p>

                <p>
                    <label for="mdp_id">Mot de Passe</label> :
                    <input type="password" name="mdp" id="mdp"  required>
                </p>
                <input type='hidden' name='action' value='connected'>
                <input type='hidden' name='controller' value='<?php echo $controller; ?>'>
                <p>
                    <input type="submit" value="Envoyer" />
                </p>
            </fieldset> 
        </form>
    </div>
</section>