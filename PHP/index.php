<?php
$ROOT_FOLDER = __DIR__;
$DS = DIRECTORY_SEPARATOR;
require_once "{$ROOT_FOLDER}{$DS}lib{$DS}File.php";
require_once File::build_path(array("lib","Session.php"));
Session::create_session();
$path = File::build_path(array("controller","router.php"));



require $path;

?>