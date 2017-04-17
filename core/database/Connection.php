<?php

namespace core\database;

use core\App;
use PDO;
use PDOException;

class Connection {
    private static $pdo = null;
    
    public static function make($database_config = null) {
        if ( ! is_null(Connection::$pdo))
            return Connection::$pdo;
        
        try {
            if (is_null($database_config))
                $database_config = App::get('config')["database"];
            
            Connection::$pdo = new PDO("mysql:dbname={$database_config["database"]}; host={$database_config["host"]}", $database_config["username"], $database_config["password"], [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
            
            return Connection::$pdo;
        }
        catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }
}