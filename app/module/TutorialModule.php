<?php

namespace app\module;

use app\model\Page;
use app\model\Tutorial;
use app\model\TutorialPage;
use core\database\QueryBuilder;

class TutorialModule {
    public function fetch_all() {
        $query_builder = new QueryBuilder();
        $tutorials     = $query_builder->set_table(Tutorial::class)
            ->query();
        
        foreach ($tutorials as $key => $tutorial) {
            $query_builder = new QueryBuilder();
            $pages         = $query_builder->set_table(Page::class)
                ->add_join(TutorialPage::class, "tutorial_page.page_id = page.page_id")
                ->add_where("tutorial_page.tutorial_id = :tutorial_id")
                ->add_variables("tutorial_id", $tutorial->get("tutorial_id"))
                ->query();
            
            $tutorials[$key]->set("pages", $pages);
            $tutorials[$key]->set("pages_count", count($pages));
        }
        
        return $tutorials;
    }
    
    public function find($hash) {
        $query_builder = new QueryBuilder();
        $tutorial      = $query_builder->set_table(Tutorial::class)
            ->add_where("hash = :hash")
            ->add_variables("hash", $hash)
            ->set_result_type(QueryBuilder::QUERY_OPTION_RESULT_SINGULAR)
            ->query();
        
        $query_builder = new QueryBuilder();
        $pages         = $query_builder->set_table(Page::class)
            ->add_join(TutorialPage::class, "tutorial_page.page_id = page.page_id")
            ->add_where("tutorial_page.tutorial_id = :tutorial_id")
            ->add_variables("tutorial_id", $tutorial->get("tutorial_id"))
            ->query();
        
        $tutorial->set("pages", $pages);
        $tutorial->set("pages_count", count($pages));
        
        return $tutorial;
    }
}