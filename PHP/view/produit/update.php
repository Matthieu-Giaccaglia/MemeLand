<section>
    <div>
        <form method="post" action="?controller=produit&action=<?php echo $action; ?>" enctype="multipart/form-data">
            <fieldset>
                <legend>Mon formulaire :</legend>
                    <input type="hidden" value="<?php echo $produit->get('id_produit'); ?>" name="id_produit"/>
                <p>
                    <label for="nom_id">Nom</label> :
                    <input type="text" value="<?php echo $produit->get('nom'); ?>" name="nom" id="nom_id" required='true'>
                </p>
                <p>
                    <label for="description_id">Description</label> :
                    <input type="text" value="<?php echo $produit->get('description'); ?>" name="description" id="description_id"  required='true'>
                </p>
                <p>
                    <label for="prix_id">Prix</label> :
                    <input type="text" value="<?php echo $produit->get('prix'); ?>" name="prix" id="prix_id"  required='true'>
                </p>
                <p>
                    <label for="couleur_id">Couleur</label> :
                    <input type="text" value="<?php echo $produit->get('couleur'); ?>" name="couleur" id="couleur_id" required='true'>
                </p>
                <p>
                    <label for="categorie_id">Categorie</label> :
                    <select name="categorie_id" <?php if($required) echo 'required'; ?>>
                        <option value="<?php echo $produit->get('categorie_id'); ?>" disabled selected>Catégorie</option>
                        <option value="pull">Pull</option>
                        <option value="pins">Pins</option>
                    </select> 
                </p>
                <p>
                    <label for="image_id">Upload une image :</label> :
                    <input type="file" value="<?php echo $produit->get('image'); ?>" name="monFichier" id="image_id" <?php if($required) echo 'required';?> >
                </p>
                
                <p>
                    <input type="submit" value="Envoyer" />
                </p>
            </fieldset> 
        </form>
    </div>
</section>