<?php

namespace app\controller;

use core\database\generate\ModelGenerator;
use core\Request;

class DefaultController {
    public function home() {
        return view("tutorial.home");
    }
    
    public function tutorial() {
        return view("tutorial.tutorial", ["current_page" => "tutorial"]);
    }
    
    public function authorization() {
        return view("tutorial.authorization", ["current_page" => "authorization"]);
    }
    
    public function route_and_request() {
        return view("tutorial.route_and_request", ["current_page" => "route-and-request"]);
    }
    
    public function controller_and_module() {
        return view("tutorial.controller_and_module", ["current_page" => "controller-and-module"]);
    }
    
    public function model() {
        return view("tutorial.model", ["current_page" => "model"]);
    }
    
    public function query_builder() {
        return view("tutorial.query_builder", ["current_page" => "query-builder"]);
    }
    
    public function blade() {
        return view("tutorial.blade", ["current_page" => "blade"]);
    }
    
    public function generate_model() {
        $model_generated = new ModelGenerator();
        $model_generated->generate_models();
    }
}