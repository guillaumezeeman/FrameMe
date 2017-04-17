<?php
                
namespace app\model;

class UsersGroups implements BaseModelInterface {
    use BaseModelTrait;
    
    private $table = 'users_groups';

    /*** The following logic is auto generated. DO NOT REMOVE!!. ***/

    /**
    * @var  array $columns
    */
    private $columns = [
    "id" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "users_groups",
        "column_name" => "id",
        "ordinal_position" => "1",
        "default" => "",
        "is_nullable" => "NO",
        "data_type" => "integer",
        "type" => "int(10) unsigned",
        "extra" => "auto_increment",
        ],
    "user_id" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "users_groups",
        "column_name" => "user_id",
        "ordinal_position" => "2",
        "default" => "",
        "is_nullable" => "NO",
        "data_type" => "integer",
        "type" => "int(10) unsigned",
        "extra" => "",
        ],
    "group_id" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "users_groups",
        "column_name" => "group_id",
        "ordinal_position" => "3",
        "default" => "",
        "is_nullable" => "NO",
        "data_type" => "integer",
        "type" => "int(10) unsigned",
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