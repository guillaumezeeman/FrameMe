<?php
                
namespace app\model;

class Groups implements BaseModelInterface {
    use BaseModelTrait;
    
    private $table = 'groups';

    /*** The following logic is auto generated. DO NOT REMOVE!!. ***/

    /**
    * @var  array $columns
    */
    private $columns = [
    "id" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "groups",
        "column_name" => "id",
        "ordinal_position" => "1",
        "default" => "",
        "is_nullable" => "NO",
        "data_type" => "integer",
        "type" => "int(10) unsigned",
        "extra" => "auto_increment",
        ],
    "name" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "groups",
        "column_name" => "name",
        "ordinal_position" => "2",
        "default" => "",
        "is_nullable" => "NO",
        "data_type" => "string",
        "type" => "varchar(255)",
        "extra" => "",
        ],
    "permissions" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "groups",
        "column_name" => "permissions",
        "ordinal_position" => "3",
        "default" => "",
        "is_nullable" => "YES",
        "data_type" => "string",
        "type" => "text",
        "extra" => "",
        ],
    "created_at" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "groups",
        "column_name" => "created_at",
        "ordinal_position" => "4",
        "default" => "0000-00-00 00:00:00",
        "is_nullable" => "NO",
        "data_type" => "DateTime",
        "type" => "timestamp",
        "extra" => "",
        ],
    "updated_at" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "groups",
        "column_name" => "updated_at",
        "ordinal_position" => "5",
        "default" => "0000-00-00 00:00:00",
        "is_nullable" => "NO",
        "data_type" => "DateTime",
        "type" => "timestamp",
        "extra" => "",
        ],
    ];

    /**
    * @var  array $keys
    */
    private $keys = [
        "id",
    ];
    /*** The end of the auto generated logic. ***/

}