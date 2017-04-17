<?php
                
namespace app\model;

class Page implements BaseModelInterface {
    use BaseModelTrait;
    
    private $table = 'page';

    /*** The following logic is auto generated. DO NOT REMOVE!!. ***/

    /**
    * @var  array $columns
    */
    private $columns = [
    "page_id" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "page",
        "column_name" => "page_id",
        "ordinal_position" => "1",
        "default" => "",
        "is_nullable" => "NO",
        "data_type" => "integer",
        "type" => "int(11)",
        "extra" => "auto_increment",
        ],
    "name" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "page",
        "column_name" => "name",
        "ordinal_position" => "2",
        "default" => "",
        "is_nullable" => "NO",
        "data_type" => "string",
        "type" => "varchar(100)",
        "extra" => "",
        ],
    "title" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "page",
        "column_name" => "title",
        "ordinal_position" => "3",
        "default" => "",
        "is_nullable" => "NO",
        "data_type" => "string",
        "type" => "varchar(100)",
        "extra" => "",
        ],
    "description" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "page",
        "column_name" => "description",
        "ordinal_position" => "4",
        "default" => "",
        "is_nullable" => "NO",
        "data_type" => "string",
        "type" => "varchar(255)",
        "extra" => "",
        ],
    ];

    /**
    * @var  array $keys
    */
    private $keys = [
        "page_id",
    ];
    /*** The end of the auto generated logic. ***/

}