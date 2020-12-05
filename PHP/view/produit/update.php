<div>
    <form method="get" action="">
        <fieldset>
            <legend>Mon formulaire :</legend>
            <p>
                <label for="id_produit_id">Id</label> :
                <input type="number" value="<?php echo $produit->get('id_produit'); ?>" name="id_produit" id="id_produit_id" <?php echo $readOrReq ?>>
            </p>
            <p>
                <label for="nom_id">Nom</label> :
                <input type="text" value="<?php echo $produit->get('nom'); ?>" name="nom" id="nom_id" required>
            </p>
            <p>
                <label for="description_id">Description</label> :
                <input type="text" value="<?php echo $produit->get('description'); ?>" name="description" id="description_id"  required>
            </p>
            <p>
                <label for="prix_id">Prix</label> :
                <input type="text" value="<?php echo $produit->get('prix'); ?>" name="prix" id="prix_id"  required>
            </p>
            <p>
                <label for="couleur_id">Couleur</label> :
                <input type="text" value="<?php echo $produit->get('couleur'); ?>"name="couleur" id="couleur_id" >
            </p>
            <p>
                <label for="categorie_id">Categorie</label> :
                <input type="text" value="<?php echo $produit->get('categorie_id'); ?>"name="categorie_id" id="categorie_id"  required>
            </p>
            <p>
                <label for="image_id">Image</label> :
                <input type="text" value="<?php echo $produit->get('image'); ?>"name="image" id="image_id"  required>
            </p>
            <input type='hidden' name='action' value='<?php echo $action; ?>'>
            <input type='hidden' name='controller' value='<?php echo $controller; ?>'>
            <p>
                <input type="submit" value="Envoyer" />
            </p>
        </fieldset> 
    </form>
</div>
