<?php

namespace core\exception;

use core\App;
use core\TemplateEngine;
use Philo\Blade\Blade;

use \Exception as BaseException;

class ExceptionHandler {
    
    /**
     * @param BaseException $exception
     */
    public static function handle(BaseException $exception) {
        try {
            $config = App::get("config");
            if (in_array(ExceptionInterface::class, class_implements($exception)) && $exception->has_view()) {
                try {
                    $view_directory  = "{$config["base_path"]}/app/view";
                    $cache_directory = "{$config["base_path"]}/app/cache/view";
                    
                    $name = static::set_view($exception->get_view(), $view_directory, $cache_directory);
                } catch (ViewNotFoundException $exception) { }
            }
            
            if (empty($name))
                $name = static::set_default_view();
            
            echo TemplateEngine::render($name, ["exception" => $exception]);
        } catch (Exception $exception) {
            dd("Oops, something went seriously wrong.");
        }
    }
    
    /**
     * Create the Blade handler and set the View
     *
     * @param $name
     * @param $view_directory
     * @param $cache_directory
     *
     * @return null|string
     * @internal param Exception $exception
     */
    public static function set_view($name, $view_directory, $cache_directory) {
        App::bind("blade", new Blade($view_directory, $cache_directory));
        TemplateEngine::set_view($name);
        
        return $name;
    }
    
    /**
     * Create the Blade handler and set the View
     *
     * @return null|string
     */
    public static function set_default_view() {
        $config = App::get("config");
    
        $view_directory  = "{$config["base_path"]}/core/exception/view";
        $cache_directory = "{$config["base_path"]}/core/exception/view/cache";
    
        return static::set_view("default_exception", $view_directory, $cache_directory);
    }
}