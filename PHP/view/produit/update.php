<?php

    if ($action == 'created') {
        $produit = new ModelProduit(array(
            'id_produit' => "",
            'nom' => "",
            'description' => "",
            'prix' => "",
            'categorie_id' => "",
            'couleur' => "",
            'disponible' =>"",
            'image' => ""
        ));
        
        $required = true;  
    } else if ($action == 'updated') {

        $id_produit = myGet('id_produit');
        if(!is_null($id_produit))
            $produit = ModelProduit::select($id_produit);

        $required = false;
    }
?>



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
                    <input type="number" value="<?php echo $produit->get('prix'); ?>" name="prix" id="prix_id"  required='true'>
                </p>
                <p>
                    <label for="couleur_id">Couleur</label> :
                    <input type="text" value="<?php echo $produit->get('couleur'); ?>" name="couleur" id="couleur_id" required='true'>
                </p>
                <p>
                    <label for="categorie_id">Categorie</label> :
                    <select name="categorie_id" <?php if($required) echo 'required';?> >
                        <option value="chaussure" <?php  if($produit->get('categorie_id')=='chaussure') echo "selected='selected'"; ?>>Chaussure</option>
                        <option value="shirt" <?php  if($produit->get('categorie_id')=='shirt') echo "selected='selected'"; ?>>Shirt</option>
                        <option value="pull" <?php  if($produit->get('categorie_id')=='pull') echo "selected='selected'"; ?>>Pull</option>
                        <option value="pins" <?php  if($produit->get('categorie_id')=='pins') echo "selected='selected'"; ?>>Pins</option>
                    </select> 
                </p>
                <p>
                    <input type="checkbox" value="" name="disponible" id="disponible_id" <?php if($produit->get('disponible')) echo 'checked';?> >
                    <label for="disponible_id">Disponible</label>
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