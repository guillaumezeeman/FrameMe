<?php

namespace app\model;

interface BaseModelInterface {
    
    public function table();
    
    public function class();
    
    public function set($key, $value);
    
    public function fill(array $variables = []);
    
    public function get($key);
    
    public function all();
    
    public function attribute($key);
    
    public function columns();
    
    public function column_values();
    
    public function keys();
}