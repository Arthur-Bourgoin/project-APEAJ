<?php

namespace Config;

class Database {

    private static $server = "localhost";
    private static $db = "carnetadresse";
    //private static $login = "userTP3";
    //private static $pwd = "iutinfo";
    private static $login = "root";
    private static $pwd = "";
    private static $linkpdo = null;

    private function __contruct() {}

    public static function getInstance() : \PDO {
        if(self::$linkpdo === null)
            self::$linkpdo = new \PDO("mysql:host=" . self::$server . ";dbname=" . self::$db, self::$login, self::$pwd);
        return self::$linkpdo;
    }


}