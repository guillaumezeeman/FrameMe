<?php

namespace core\exception;

interface ExceptionInterface {
    public function has_view();
    
    public function set_view($view);
    
    public function get_view();
}