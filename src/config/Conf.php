<?php
class Conf {
  
  static private $debug = true;

  static private $databases = array(

    'hostname' => 'localhost',
    'database' => 'memeland',
    'login' => 'root',
    'password' => 'root'
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
