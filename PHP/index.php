<?php

/*if(!isset($_COOKIE['TestCookie']))
    setcookie("TestCookie", serialize(array()), 120);*/

session_start();
if(!isset($_SESSION['panier']))
    $_SESSION['panier'] = array();

if(!isset($_SESSION['connected']))
    $_SESSION['connected'] = false;

$ROOT_FOLDER = __DIR__;
$DS = DIRECTORY_SEPARATOR;
require_once "{$ROOT_FOLDER}{$DS}lib{$DS}File.php";

$path = File::build_path(array("controller","router.php"));


require $path;

?>