<?php

namespace app\module;

use core\Request;

trait BaseModule {
    /**
     * @var Request $request
     */
    private $request;
    
    /**
     * @return Request
     */
    public function getRequest(): Request {
        return $this->request;
    }
    
    /**
     * @param Request $request
     */
    public function setRequest(Request $request) {
        $this->request = $request;
    }
}