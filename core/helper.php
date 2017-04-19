<?php

use core\App;
use core\Router;
use core\TemplateEngine;
use Cartalyst\Sentry\Facades\Native\Sentry as Sentry;

function dump(...$variables) {
    echo "<pre>";
    foreach ($variables as $variable)
        var_dump($variable);
    
    echo "</pre>";
}

function view($name, $options = []) {
    echo TemplateEngine::render($name, $options);
}

function asset($uri) {
    $protocol = "http";
    if (array_key_exists("HTTPS", $_SERVER) && "on" == strtolower($_SERVER["HTTPS"]))
        $protocol = "https";
    elseif (array_key_exists("REQUEST_SCHEME", $_SERVER))
        $protocol = strtolower($_SERVER["REQUEST_SCHEME"]);
    
    return "{$protocol}://{$_SERVER["SERVER_NAME"]}/" . App::get("config")["base_url"] . $uri;
}

function image($uri) {
    $base_image_path = App::get("config")["base_path"] . "/public/images";
    if ( ! file_exists($base_image_path . "/" . $uri))
        return asset("images/image_not_found_sm.jpg");
    
    return asset("images/" . $uri);
}

function url($name, array $parameters = []) {
    return Router::generate_url($name, $parameters);
}

function redirect($name, array $parameters = []) {
    header("location: " . Router::generate_url($name, $parameters));
}