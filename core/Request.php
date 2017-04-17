<?php

namespace core;

class Request {
    private $parameters = [
        "GET"    => [],
        "POST"   => [],
        "PUT"    => [],
        "DELETE" => [],
        "uri"    => [],
    ];
    
    public static function uri() {
        $uri = str_replace(App::get("config")["base_url"], "", $_SERVER["REQUEST_URI"]);
        $uri = parse_url($uri, PHP_URL_PATH);
        if (empty($uri))
            $uri = "/";
        
        return $uri;
    }
    
    public static function method() {
        return $_SERVER["REQUEST_METHOD"];
    }
    
    public function __construct() {
        if ( ! empty($_GET))
            foreach ($_GET as $key => $value)
                $this->parameters["GET"][$key] = $value;
        
        if ( ! empty($_POST))
            foreach ($_POST as $key => $value)
                $this->parameters["POST"][$key] = $value;
    }
    
    public function add($key, $value, string $type = "uri") {
        if (empty($type) || empty($key) || empty($value))
            return;
        
        $this->parameters[$type][$key] = $value;
    }
    
    //    public function add_parameter($key, $value, $index = null) {
    //        if (empty($value))
    //            return;
    //
    //        if (is_null($index)) {
    //            $this->parameters[] = ["key" => $key, "value" => $value];
    //        }
    //        else {
    //            $split = array_splice($this->parameters, $index);
    //            $this->parameters[] = ["key" => $key, "value" => $value];
    //            foreach ($split as $item)
    //                $this->parameters[] = $item;
    //        }
    //    }
    
    public function all($type = null) {
        if ( ! is_null($type) && array_key_exists(strtoupper($type), $this->parameters))
            return $this->parameters[strtoupper($type)];
        
        return $this->parameters;
    }
    
    public function get($key) {
        foreach ($this->parameters as $parameter_type)
            if (array_key_exists($key, $parameter_type))
                return $parameter_type[$key];
        
        return null;
    }
    
    public function has($key) {
        foreach ($this->parameters as $parameter_type)
            if (array_key_exists($key, $parameter_type))
                return true;
        
        return false;
    }
    
    public function is_empty($key) {
        if ( ! $this->has($key) || empty($this->get($key)))
            return true;
        
        return false;
    }
}