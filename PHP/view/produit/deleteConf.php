<?php
    $id_produit = $_GET['id_produit'];
    echo "  <aside>
                <p>Êtes-vous certains de vouloir supprimer à jamais ce produit ? Cela pourrait avoir un impact sur les commandes passées des utilisateurs</p>
            
                <div class='button'>
                    <form method='get' action=''>
                        <input type='hidden' name='action' value='delete'>
                        <input type='hidden' name='controller' value='produit'>
                        <input type='hidden' name='id_produit' value='$id_produit'>
                        <input class='b_input' type='submit' value='Confirmer' />
                    </form>
                </div>
            </aside>";
?>