<?php

namespace app\controller;

use app\module\UserModule;
use core\Request;
use core\Router;
use Cartalyst\Sentry\Facades\Native\Sentry as Sentry;

class UserController {
    public function show_login() {
        view("auth.login");
    }
    
    public function login(Request $request) {
        $user_module = new UserModule();
        $user_module->login($request);
        
        header("Location: " . Router::generate_url("homepage"));
    }
    
    public function show_registration() {
        view("auth.register");
    }
    
    public function register(Request $request) {
        $user_module = new UserModule();
        $user_module->register($request);
        
        header("Location: " . Router::generate_url("homepage"));
    }
    
    public function logout() {
        if (Sentry::check())
            Sentry::logout();
        
        header("Location: " . Router::generate_url("homepage"));
    }
}