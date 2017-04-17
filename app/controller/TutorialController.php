<?php

namespace app\controller;

use app\module\TutorialModule;
use Cartalyst\Sentry\Facades\Native\Sentry as Sentry;
use core\Request;

class TutorialController {
    public function overview() {
        if ( ! Sentry::check())
            redirect('login_page');
        
        $tutorial_module = new TutorialModule();
        $tutorials       = $tutorial_module->fetch_all();
        
        view('tutorial.use_case.overview', ["tutorials" => $tutorials]);
    }
    
    public function details(Request $request) {
        if ( ! Sentry::check())
            redirect('login_page');
        
        if ($request->is_empty("hash"))
            redirect('use_case');
        
        $tutorial_module = new TutorialModule();
        $tutorial        = $tutorial_module->find($request->get("hash"));
        
        view('tutorial.use_case.details', ["tutorial" => $tutorial]);
    }
}