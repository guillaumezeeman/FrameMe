<?php
                
namespace app\model;

class Tutorial implements BaseModelInterface {
    use BaseModelTrait;
    
    private $table = 'tutorial';

    /*** The following logic is auto generated. DO NOT REMOVE!!. ***/

    /**
    * @var  array $columns
    */
    private $columns = [
    "tutorial_id" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "tutorial",
        "column_name" => "tutorial_id",
        "ordinal_position" => "1",
        "default" => "",
        "is_nullable" => "NO",
        "data_type" => "integer",
        "type" => "int(11)",
        "extra" => "auto_increment",
        ],
    "name" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "tutorial",
        "column_name" => "name",
        "ordinal_position" => "2",
        "default" => "",
        "is_nullable" => "NO",
        "data_type" => "string",
        "type" => "varchar(100)",
        "extra" => "",
        ],
    "description" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "tutorial",
        "column_name" => "description",
        "ordinal_position" => "3",
        "default" => "",
        "is_nullable" => "NO",
        "data_type" => "string",
        "type" => "varchar(255)",
        "extra" => "",
        ],
    "hash" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "tutorial",
        "column_name" => "hash",
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
        "tutorial_id",
    ];
    /*** The end of the auto generated logic. ***/

}