<section>
    <div>
        <form method="get" action="?controller=commande&action=<?php echo $action; ?>" enctype="multipart/form-data">
            <fieldset>
                <legend>Mon formulaire :</legend>
                    <input type="hidden" value="<?php echo $commande->get('id_commande'); ?>" name="id_commande"/>
                <p>
                    <label for="utilisateur_login_id">Login Utilisateur</label> :
                    <input type="text" value="<?php echo $commande->get('utilisateur_login'); ?>" name="utilisateur_login" id="utilisateur_login_id" readonly/>
                </p>
                <p>
                    <label for="date_id">Date</label> :
                    <input type="text" value="<?php echo $commande->get('date'); ?>" name="date" id="date_id"  required='true'/>
                </p>
                <p>
                    <label for="prix_total_id">Prix Total</label> :
                    <input type="text" value="<?php echo $commande->get('prix_total'); ?>" name="prix_total" id="prix_total_id"  required='true'/>
                </p>
                <p>
                    <input type="submit" value="Envoyer" />
                </p>
            </fieldset> 
        </form>
    </div>
</section>