<?php
                
namespace app\model;

class Users implements BaseModelInterface {
    use BaseModelTrait;
    
    private $table = 'users';

    /*** The following logic is auto generated. DO NOT REMOVE!!. ***/

    /**
    * @var  array $columns
    */
    private $columns = [
    "id" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "users",
        "column_name" => "id",
        "ordinal_position" => "1",
        "default" => "",
        "is_nullable" => "NO",
        "data_type" => "integer",
        "type" => "int(10) unsigned",
        "extra" => "auto_increment",
        ],
    "email" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "users",
        "column_name" => "email",
        "ordinal_position" => "2",
        "default" => "",
        "is_nullable" => "NO",
        "data_type" => "string",
        "type" => "varchar(255)",
        "extra" => "",
        ],
    "password" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "users",
        "column_name" => "password",
        "ordinal_position" => "3",
        "default" => "",
        "is_nullable" => "NO",
        "data_type" => "string",
        "type" => "varchar(255)",
        "extra" => "",
        ],
    "permissions" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "users",
        "column_name" => "permissions",
        "ordinal_position" => "4",
        "default" => "",
        "is_nullable" => "YES",
        "data_type" => "string",
        "type" => "text",
        "extra" => "",
        ],
    "activated" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "users",
        "column_name" => "activated",
        "ordinal_position" => "5",
        "default" => "0",
        "is_nullable" => "NO",
        "data_type" => "integer",
        "type" => "tinyint(4)",
        "extra" => "",
        ],
    "activation_code" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "users",
        "column_name" => "activation_code",
        "ordinal_position" => "6",
        "default" => "",
        "is_nullable" => "YES",
        "data_type" => "string",
        "type" => "varchar(255)",
        "extra" => "",
        ],
    "activated_at" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "users",
        "column_name" => "activated_at",
        "ordinal_position" => "7",
        "default" => "",
        "is_nullable" => "YES",
        "data_type" => "string",
        "type" => "varchar(255)",
        "extra" => "",
        ],
    "last_login" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "users",
        "column_name" => "last_login",
        "ordinal_position" => "8",
        "default" => "",
        "is_nullable" => "YES",
        "data_type" => "string",
        "type" => "varchar(255)",
        "extra" => "",
        ],
    "persist_code" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "users",
        "column_name" => "persist_code",
        "ordinal_position" => "9",
        "default" => "",
        "is_nullable" => "YES",
        "data_type" => "string",
        "type" => "varchar(255)",
        "extra" => "",
        ],
    "reset_password_code" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "users",
        "column_name" => "reset_password_code",
        "ordinal_position" => "10",
        "default" => "",
        "is_nullable" => "YES",
        "data_type" => "string",
        "type" => "varchar(255)",
        "extra" => "",
        ],
    "first_name" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "users",
        "column_name" => "first_name",
        "ordinal_position" => "11",
        "default" => "",
        "is_nullable" => "YES",
        "data_type" => "string",
        "type" => "varchar(255)",
        "extra" => "",
        ],
    "last_name" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "users",
        "column_name" => "last_name",
        "ordinal_position" => "12",
        "default" => "",
        "is_nullable" => "YES",
        "data_type" => "string",
        "type" => "varchar(255)",
        "extra" => "",
        ],
    "created_at" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "users",
        "column_name" => "created_at",
        "ordinal_position" => "13",
        "default" => "0000-00-00 00:00:00",
        "is_nullable" => "NO",
        "data_type" => "DateTime",
        "type" => "timestamp",
        "extra" => "",
        ],
    "updated_at" => [
        "table_schema" => "k39392_frameme",
        "table_name" => "users",
        "column_name" => "updated_at",
        "ordinal_position" => "14",
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