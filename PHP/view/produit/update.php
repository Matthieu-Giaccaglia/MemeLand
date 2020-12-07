<div>
    <form method="post" action="?controller=produit&action=<?php echo $action; ?>" enctype="multipart/form-data">
        <fieldset>
            <legend>Mon formulaire :</legend>
            <p>
                <label for="id_produit_id">Id</label> :
                <input type="number" value="<?php echo $produit->get('id_produit'); ?>" name="id_produit" id="id_produit_id" readonly>
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
                <input type="text" value="<?php echo $produit->get('couleur'); ?>" name="couleur" id="couleur_id" >
            </p>
            <p>
                <label for="categorie_id">Categorie</label> :
                <input type="text" value="<?php echo $produit->get('categorie_id'); ?>" name="categorie_id" id="categorie_id"  required>
            </p>
            <p>
                <label for="image_id">Image</label> :
                <input type="text" value="<?php echo $produit->get('image'); ?>" name="image" id="image_id"  required>
            </p>
            <p>
                <label for="image_id">Upload une image :</label> :
                <input type="file" value="<?php echo $produit->get('image'); ?>" name="image" id="image_id"  required>
            </p>
            
            <p>
                <input type="submit" value="Envoyer" />
            </p>
        </fieldset> 
    </form>
</div>
