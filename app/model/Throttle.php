<?php
                
namespace app\model;

class Throttle implements BaseModelInterface {
    use BaseModelTrait;
    
    private $table = 'throttle';

    /*** The following logic is auto generated. DO NOT REMOVE!!. ***/

    /**
    * @var  array $columns
    */
    private $columns = [
    "id" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "throttle",
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
        "table_name" => "throttle",
        "column_name" => "user_id",
        "ordinal_position" => "2",
        "default" => "",
        "is_nullable" => "NO",
        "data_type" => "integer",
        "type" => "int(10) unsigned",
        "extra" => "",
        ],
    "ip_address" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "throttle",
        "column_name" => "ip_address",
        "ordinal_position" => "3",
        "default" => "",
        "is_nullable" => "YES",
        "data_type" => "string",
        "type" => "varchar(255)",
        "extra" => "",
        ],
    "attempts" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "throttle",
        "column_name" => "attempts",
        "ordinal_position" => "4",
        "default" => "0",
        "is_nullable" => "NO",
        "data_type" => "integer",
        "type" => "int(11)",
        "extra" => "",
        ],
    "suspended" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "throttle",
        "column_name" => "suspended",
        "ordinal_position" => "5",
        "default" => "0",
        "is_nullable" => "NO",
        "data_type" => "integer",
        "type" => "tinyint(4)",
        "extra" => "",
        ],
    "banned" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "throttle",
        "column_name" => "banned",
        "ordinal_position" => "6",
        "default" => "0",
        "is_nullable" => "NO",
        "data_type" => "integer",
        "type" => "tinyint(4)",
        "extra" => "",
        ],
    "last_attempt_at" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "throttle",
        "column_name" => "last_attempt_at",
        "ordinal_position" => "7",
        "default" => "",
        "is_nullable" => "YES",
        "data_type" => "DateTime",
        "type" => "timestamp",
        "extra" => "",
        ],
    "suspended_at" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "throttle",
        "column_name" => "suspended_at",
        "ordinal_position" => "8",
        "default" => "",
        "is_nullable" => "YES",
        "data_type" => "DateTime",
        "type" => "timestamp",
        "extra" => "",
        ],
    "banned_at" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "throttle",
        "column_name" => "banned_at",
        "ordinal_position" => "9",
        "default" => "",
        "is_nullable" => "YES",
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