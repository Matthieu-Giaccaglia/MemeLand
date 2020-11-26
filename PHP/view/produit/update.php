<div>
    <form method="get" action="">
        <fieldset>
            <legend>Mon formulaire :</legend>
            <p>
                <label for="nom_id">Nom</label> :
                <input type="text" value="<?php echo $nomHTML; ?>" name="nomP" id="nom_id" required>
            </p>
            <p>
                <label for="description_id">Description</label> :
                <input type="text" value="<?php echo $descriptionHTML; ?>" name="description" id="description_id"  required>
            </p>
            <p>
                <label for="prix_id">Prix</label> :
                <input type="text" value="<?php echo $prixHTML; ?>" name="prix" id="prix_id"  required>
            </p>
            <p>
                <label for="couleur_id">Couleur</label> :
                <input type="text" value="<?php echo $idCouleurHTML; ?>"name="idCouleur" id="couleur_id"  required>
            </p>
            <p>
                <label for="categorie_id">Couleur</label> :
                <input type="text" value="<?php echo $idCategorieHTML; ?>"name="idCategorie" id="categorie_id"  required>
            </p>
            <input type='hidden' name='action' value='<?php echo $next_action; ?>'>
            <input type='hidden' name='controller' value='<?php echo $controller; ?>'>
            <p>
                <input type="submit" value="Envoyer" />
            </p>
        </fieldset> 
    </form>
</div>
