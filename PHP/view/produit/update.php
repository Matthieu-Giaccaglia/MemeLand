<div>
    <form method="get" action="">
        <fieldset>
            <legend>Mon formulaire :</legend>
            <p>
                <label for="immat_id">Immatriculation</label> :
                <input type="text" value="<?php echo $immatHTML; ?>" placeholder="Ex : 256AB34" name="immatriculation" id="immat_id" <?php echo $primary_property; ?>>
            </p>
            <p>
                <label for="marque_id">Marque</label> :
                <input type="text" value="<?php echo $marqueHTML; ?>" placeholder="Ex : Renault" name="marque" id="marque_id"  required>
            </p>
            <p>
                <label for="couleur_id">Couleur</label> :
                <input type="text" value="<?php echo $couleurHTML; ?>" placeholder="Ex : Bleu" name="couleur" id="couleur_id"  required>
            </p>
            <input type='hidden' name='action' value='<?php echo $next_action; ?>'>
            <input type='hidden' name='controller' value='<?php echo $controller; ?>'>
            <p>
                <input type="submit" value="Envoyer" />
            </p>
        </fieldset> 
    </form>
</div>
