<?php

namespace core;

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
        
        // Create Blode handler
        App::bind("blade", new Blade($config["view_directory"], $config["cache_directory"]));
    }
    
    public function send() {
        Router::load("../app/routes.php")->direct(Request::uri(), Request::method());
    }
}