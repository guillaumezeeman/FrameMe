<?php

namespace app\model;


use Exception;

trait BaseModelTrait {
    private $fillable  = [];
    private $variables = [];
    
    public function table() {
        return $this->table;
    }
    
    public function class() {
        return self::class;
    }
    
    public function set($key, $value) {
        if (empty($key))
            throw new Exception("Invalid parameters given.");
    
        $this->variables[$key] = $value;
        
        return $this;
    }
    
    public function fill(array $variables = []) {
        foreach ($variables as $key => $variable) {
            if (is_numeric($key) || ! array_key_exists($key, $this->columns) || ! in_array($key, $this->fillable) || is_null($variable) || "" === $variable)
                continue;
            
            $this->set($key, $variable);
        }
        
        return $this;
    }
    
    public function has($key) {
        return array_key_exists($key, $this->variables);
    }
    
    public function get($key) {
        if ( ! $this->has($key))
            return null;
        
        return $this->variables[$key];
    }
    
    public function all() {
        return $this->variables;
    }
    
    public function attribute($key) {
        if ( ! in_array($key, $this->product_attributes))
            return null;
    
        if ( ! array_key_exists($key, $this->variables))
            return null;
    
        return $this->variables[$key];
    }
    
    public function columns() {
        return $this->columns;
    }
    
    public function column_values() {
        if (empty($this->columns()))
            return [];
        
        $columns = [];
        foreach ($this->columns() as $column => $attributes) {
            if ($this->has($column))
                $columns["$column"] = $this->get($column);
        }
        
        return $columns;
    }
    
    public function keys() {
        return $this->keys;
    }
}