<?php
error_reporting(E_ALL);

class DB{

    private static $host = 'localhost';
    private static $db = 'proyecto';

    private static $user = 'root';

    private static $password = '';
    private static $cont  = null;

    public static function connect() {
        if ( null == self::$cont ) {
            try {
                self::$cont =  new PDO( "mysql:host=".self::$host.";"."dbname=".self::$db, self::$user, self::$password);
            } catch(PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$cont;
    }

    public static function disconnect() {
        self::$cont = null;
    }
}
?>