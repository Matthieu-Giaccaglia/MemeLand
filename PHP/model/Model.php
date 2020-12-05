<?php

require_once File::build_path(array("config", "Conf.php"));

class Model {

    public static $pdo;

    public static function Init() {
        $host = Conf::getHostname();
        $dbname = Conf::getDatabase();
        $login = Conf::getLogin();
        $pass = Conf::getPassword();

        try {
            self::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $login, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

public static function selectAll() {
        try {
            $pdo = self::$pdo;
            $table_name = "p_" . static::$object;
            $class_name = 'Model' . ucfirst(static::$object);
            
            $sql = "SELECT * from $table_name";
            $rep = $pdo->query($sql);
            $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            return $rep->fetchAll();
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function select($primary) {
        try {
            $table_name = "p_" . static::$object;
            $class_name = 'Model' . ucfirst(static::$object);
            $primary_key = static::$primary;
            $sql = "SELECT * from $table_name WHERE $primary_key=:primary";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "primary" => $primary
            );
            // On donne les valeurs et on exécute la requête	 
            $req_prep->execute($values);

            // On récupère les résultats comme précédemment
            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $tab_results = $req_prep->fetchAll();
            // Attention, si il n'y a pas de résultats, on renvoie false
            if (empty($tab_results))
                return false;
            return $tab_results[0];
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function delete($primary) {
        try {
            $table_name = static::$object;
            $primary_key = static::$primary;
            $sql = "DELETE FROM $table_name WHERE $primary_key=:primary;";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "primary" => $primary
            );
            // On donne les valeurs et on exécute la requête	 
            return $req_prep->execute($values);
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function update($data) {
        try {
            $table_name = "p_" . static::$object;
            $primary_key = static::$primary;

            $set_parts = array();
            foreach ($data as $key => $value) {
                $set_parts[] = "$key='" . str_replace( "'", "\'", $value ) . "'";
            }

            $set_string = join(',', $set_parts);
            $sql = "UPDATE $table_name SET $set_string WHERE $primary_key=$data[$primary_key]";
            
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            // On donne les valeurs et on exécute la requête	 
            return $req_prep->execute($data);
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function save($data) {
        try {

            $table_name = "p_" . static::$object;

            $table = '';
            $value = '';

            foreach ($data as $cle => $valeur){
            
                $table = $table . "{$cle}, ";
                $value = $value . " '" . str_replace( "'", "\'", $valeur ) . "', ";
            }

            $table =substr($table,0,-1);
            $value =substr($value,0,-1);

            $table = "(" . rtrim($table,",") . ")";
            $value = "(" . rtrim($value,",") . ")";

            $sql = "INSERT INTO {$table_name} {$table} VALUES {$value}";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
            );
            // On donne les valeurs et on exécute la requête
            return $req_prep->execute();
           
        } catch (PDOException $e) {
            
            if ($e->errorInfo[1]==1062){
                return false;
            }else if (Conf::getDebug()) {
                var_dump($e);
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }
}
Model::Init();
?>
