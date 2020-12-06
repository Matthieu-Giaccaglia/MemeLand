
<?php
if(!$_SESSION['connected']){
    echo "<aside><p>Connectez vous pour finaliser vos achats</p></aside>";
    $view="connect";
    $filepath = File::build_path(array("view", static::$object, "$view.php"));
    require $filepath;
}else{
    echo "<section><p>Vous avez payé</p></section>";
    $_SESSION['panier'] = [];
}
?>