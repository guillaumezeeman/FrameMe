<?php

namespace core;

use Exception;
use ReflectionMethod;

class Router {
    private static $routes = [
        "GET"  => [],
        "POST" => [],
    ];
    
    /**
     * @var Request $request
     */
    private $request;
    
    public static function load($file) {
        require $file;
        
        return new static;
    }
    
    public static function get(string $name, string $uri, string $controller, array $parameters = []) {
        $uri                        = str_replace("/", "\\/", $uri);
        self::$routes["GET"][$name] = [
            "uri"        => $uri,
            "controller" => $controller,
            "parameters" => $parameters,
        ];
    }
    
    public static function post(string $name, string $uri, string $controller, array $parameters = []) {
        $uri                         = str_replace("/", "\\/", $uri);
        self::$routes["POST"][$name] = [
            "uri"        => $uri,
            "controller" => $controller,
            "parameters" => $parameters,
            "type"       => "GET",
        ];
    }
    
    public static function has($key) {
        foreach (self::$routes as $route_type)
            if (array_key_exists($key, $route_type))
                return true;
        
        return false;
    }
    
    public static function generate_url($name, array $parameters = []) {
        foreach (self::$routes as $route_type) {
            if (array_key_exists($name, $route_type)) {
                $uri = $route_type[$name]["uri"];
                for ($i = 0; $i <= ($parameter_count = substr_count($uri, ":")); $i++) {
                    if ( ! array_key_exists($i, $parameters) || 0 == $parameter_count)
                        continue;
                    
                    $position      = strpos($uri, ":");
                    $new_uri_value = substr($uri, 0, $position);
                    $new_uri_value .= $parameters[$i];
                    
                    $old_uri_value           = substr($uri, $position);
                    $backward_slash_position = strpos($old_uri_value, "/");
                    if ( ! empty($backward_slash_position))
                        $new_uri_value .= substr($old_uri_value, $backward_slash_position);
                    
                    $uri = $new_uri_value;
                }
                
                $uri = str_replace("\\", "", $uri);
                $uri = ltrim($uri, "/");
                
                return rtrim(asset($uri), "/");
            }
        }
        
        return asset("");
    }
    
    private static function match_regex($uri, $route) {
        $path_regex = str_replace(":num", "([0-9]+)", $route["uri"]);
        $path_regex = str_replace(":alphanum", "([a-zA-Z0-9:&_$]+)", $path_regex);
        $path_regex = str_replace(":alphaspace", "([a-zA-Z ]+)", $path_regex);
        $path_regex = str_replace(":date", "([a-zA-Z0-9\-: ]+)", $path_regex);
        $path_regex = str_replace(":alpha", "([a-zA-Z]+)", $path_regex);
        $path_regex = str_replace("\\\\", "\\", $path_regex);
        if (preg_match("/^{$path_regex}$/", $uri, $matches))
            return $matches;
        
        return null;
    }
    
    public function __construct() {
        $this->request = new Request();
    }
    
    public function direct(string $uri, string $request_type) {
        foreach (static::$routes[$request_type] as $path_name => $route) {
            $matches = self::match_regex($uri, $route);
            if (empty($matches))
                continue;
            
            $this->process_url_parameters($route["parameters"], $matches);
            $this->call_action(...explode("@", $route["controller"]));
            return;
        }
    
        throw new Exception("No route defined for this URI.");
    }
    
    private function process_url_parameters($parameters, $matches) {
        $matches = str_replace('_', ' ', $matches);
        $matches = str_replace(':', '-', $matches);
        
        foreach ($parameters as $varName => $ref) {
            if (is_numeric($ref)) {
                if (isset($matches[$ref])) {
                    $this->request->add($varName, $matches[$ref], "GET");
                }
                else {
                    $this->request->add($varName, $ref, "GET");
                }
            }
            else {
                $this->request->add($varName, $ref, "GET");
            }
        }
    }
    
    private function call_action(string $controller, string $action) {
        $controller = "app\\controller\\{$controller}";
        if ( ! class_exists($controller))
            throw new Exception("{$controller} does not respond to the {$action} action.");
        
        $controller = new $controller();
        if ( ! method_exists($controller, $action))
            throw new Exception("{$controller} does not respond to the {$action} action.");
        
        $method              = new ReflectionMethod($controller, $action);
        $argmunents          = $method->getParameters();
        $function_argmuments = [];
        foreach ($argmunents as $key => $argmunent) {
            if ( ! is_null($argmunent->getClass()) && Request::class == $argmunent->getClass()->getName())
                $function_argmuments[] = $this->request;
            elseif ($this->request->has($argmunent->getName()))
                $function_argmuments[] = $this->request->get($argmunent->getName());
        }
        
        $controller->$action(...$function_argmuments);
    }
}