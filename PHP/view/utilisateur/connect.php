<section>
    <div>
        <form method="post" action="?controller=utilisateur&action=connected">
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
                <p>
                    <input class="b_input" type="submit" value="Envoyer" />
                </p>
            </fieldset>
            <a href="index.php?controller=<?php echo $controller; ?>&action=create"><h3>Pas de compte ? S'inscrire</h3></a>
        </form>
    </div>
</section>