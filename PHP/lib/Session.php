<?php
class Session {
    public static function is_user($login) {
        return (!empty($_SESSION['login']) && ($_SESSION['login'] == $login));
    }

    public static function is_admin() {

        return (!empty($_SESSION['admin']) && $_SESSION['admin']);
    }

    public static function create_session() {
        session_start();
        if(!isset($_SESSION['panier']))
            $_SESSION['panier'] = array();

        if(!isset($_SESSION['connected']))
            $_SESSION['connected'] = false;
    }

    public static function delte_session() {

        session_unset();
        session_destroy();
    }
}
?>