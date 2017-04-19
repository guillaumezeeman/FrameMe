<?php

namespace core\exception;

use \Exception as BaseException;
use Throwable;

class Exception extends BaseException implements ExceptionInterface {
    protected $view = null;
    
    public function __construct($message = "", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
    
    public function has_view() {
        return ! empty($this->view);
    }
    
    public function set_view($view) {
        if ( ! empty($view))
            $this->view = $view;
    }
    
    public function get_view() {
        return $this->view;
    }
}