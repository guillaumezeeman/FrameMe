<?php

namespace core;

use core\exception\ExceptionHandler;
use Exception;
use Cartalyst\Sentry\Facades\Native\Sentry as Sentry;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Illuminate\Database\Capsule\Manager as Capsule;
use Philo\Blade\Blade;

class AppKernel {
    public function handle() {
        if ( ! isset($_SESSION))
            session_start();
        
        date_default_timezone_set('Europe/Amsterdam');
        $config = App::get("config");
        
        // Catch any Exceptions that are possibly thrown.
        $this->try(function() use ($config) {
            
            // Create Blode handler
            App::bind("blade", new Blade($config["view_directory"], $config["cache_directory"]));
            
            // Cartylist Database.
            $database_config   = $config["database"];
            $illuminate_config = [
                'driver'    => $database_config["driver"],
                'host'      => $database_config["host"],
                'database'  => $database_config["database"],
                'username'  => $database_config["username"],
                'password'  => $database_config["password"],
                'charset'   => $database_config["charset"],
                'collation' => $database_config["collation"],
            ];
    
            $capsule = new Capsule;
            $capsule->addConnection($illuminate_config);
            $capsule->bootEloquent();
    
            try {
                App::bind("user", Sentry::getUser()); // Get the current active/logged in user
            } catch (UserNotFoundException $e) {
                App::bind("user", null);
            }
        });
    }
    
    public function send() {
        // Catch any Exceptions that are possibly thrown.
        $this->try(function() {
            Router::load("../app/routes.php")->direct(Request::uri(), Request::method());
        });
    }
    
    public function try($function) {
        try {
            if ( ! is_callable($function))
                throw new Exception("Not a function.");
    
            $function();
        } catch (Exception $exception) {
            die(ExceptionHandler::handle($exception));
        }
    }
}