<?php
                
namespace app\model;

class TutorialPage implements BaseModelInterface {
    use BaseModelTrait;
    
    private $table = 'tutorial_page';

    /*** The following logic is auto generated. DO NOT REMOVE!!. ***/

    /**
    * @var  array $columns
    */
    private $columns = [
    "tutorial_id" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "tutorial_page",
        "column_name" => "tutorial_id",
        "ordinal_position" => "1",
        "default" => "",
        "is_nullable" => "NO",
        "data_type" => "integer",
        "type" => "int(11)",
        "extra" => "",
        ],
    "page_id" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "tutorial_page",
        "column_name" => "page_id",
        "ordinal_position" => "2",
        "default" => "",
        "is_nullable" => "NO",
        "data_type" => "integer",
        "type" => "int(11)",
        "extra" => "",
        ],
    "page_order" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "tutorial_page",
        "column_name" => "page_order",
        "ordinal_position" => "3",
        "default" => "",
        "is_nullable" => "NO",
        "data_type" => "integer",
        "type" => "int(11)",
        "extra" => "",
        ],
    ];

    /**
    * @var  array $keys
    */
    private $keys = [
        "tutorial_id",
        "page_id",
    ];
    /*** The end of the auto generated logic. ***/

}