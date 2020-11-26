<?php
class Conf {
  
  static private $debug = true;

  static private $databases = array(
    // Le nom d'hote est infolimon a l'IUT
    // ou localhost sur votre machine
    'hostname' => 'localhost',
    // A l'IUT, vous avez une BDD nommee comme votre login
    // Sur votre machine, vous devrez creer une BDD
    'database' => 'deneuvillew',
    // A l'IUT, c'est votre login
    // Sur votre machine, vous avez surement un compte 'root'
    'login' => 'deneuvillew',
    // A l'IUT, c'est votre mdp (INE par defaut)
    // Sur votre machine, vous avez creez ce mdp a l'installation
    'password' => 'Denvers01'
  );

  static public function getLogin() {
    //en PHP l'indice d'un tableau n'est pas forcement un chiffre.
    return self::$databases['login'];  //idem self::$databases[1]; 
  }
  
  static public function getHostname() {
    //en PHP l'indice d'un tableau n'est pas forcement un chiffre.
    return self::$databases['hostname'];  //idem self::$databases[1]; 
  }
  
  static public function getDatabase() {
    //en PHP l'indice d'un tableau n'est pas forcement un chiffre.
    return self::$databases['database'];  //idem self::$databases[1]; 
  }
  
  static public function getPassword() {
    //en PHP l'indice d'un tableau n'est pas forcement un chiffre.
    return self::$databases['password'];  //idem self::$databases[1]; 
  }
  
  static public function getDebug() {
    //en PHP l'indice d'un tableau n'est pas forcement un chiffre.
    return self::$debug;  //idem self::$databases[1]; 
  }

}
?>
