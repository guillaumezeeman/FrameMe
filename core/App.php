<?php

namespace core;

use Exception;

class App {
    private static $registry = [];
    
    public static function bind($key, $value) {
        static::$registry[$key] = $value;
    }
    
    public static function get($key) {
        if ( ! array_key_exists($key, static::$registry))
            throw new Exception("No {$key} is bound in the container.");
            
        return static::$registry[$key];
    }
    
    public static function has($key) {
        return array_key_exists($key, static::$registry);
    }
    
    protected static function authenticateUser() {
        if ( ! Sentry::check()) {
//            $_SESSION['flash-message'] = 'You are not authorized';
//            header("Location: http://ivalue.guillaumezeeman.nl/");
            
            die("not authorized");
        }
    }
}