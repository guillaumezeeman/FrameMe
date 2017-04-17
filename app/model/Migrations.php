<?php
                
namespace app\model;

class Migrations implements BaseModelInterface {
    use BaseModelTrait;
    
    private $table = 'migrations';

    /*** The following logic is auto generated. DO NOT REMOVE!!. ***/

    /**
    * @var  array $columns
    */
    private $columns = [
    "migration" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "migrations",
        "column_name" => "migration",
        "ordinal_position" => "1",
        "default" => "",
        "is_nullable" => "NO",
        "data_type" => "string",
        "type" => "varchar(255)",
        "extra" => "",
        ],
    "batch" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "migrations",
        "column_name" => "batch",
        "ordinal_position" => "2",
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
    ];
    /*** The end of the auto generated logic. ***/

}