<?php

namespace core\database\generate;

use app\Utilities;
use core\App;
use core\database\Connection;
use core\database\generate\FileReader;
use core\TemplateEngine;
use PDO;
use Philo\Blade\Blade;

class ModelGenerator {
    private $pdo    = null;
    private $config = null;
    
    private $auto_code_start = "/*** The following logic is auto generated. DO NOT REMOVE!!. ***/";
    private $auto_code_end   = "/*** The end of the auto generated logic. ***/";
    
    private $product_classes = [
        "laptop",
        "tv",
    ];
    
    function __construct() {
        $this->pdo    = Connection::make();
        $this->config = App::get("config");
    }
    
    /**
     * The end of the auto generated logic.
     */
    
    /**
     * The following logic is auto generated.
     * DO NOT REMOVE!!.
     */
    
    public function generate_models() {
        $file_reader = new FileReader();
        $models      = $this->get_models_from_database();
        $new_models  = 0;
        
        foreach ($models as $key => $model) {
            $model["is_product_class"] = in_array($model["name"], $this->product_classes);
            $model["class_name"]       = $this->underscore_to_camelcase($model["name"]);
            
            $response = $file_reader->get_file_content($model["class_name"]);
            if (FileReader::STATUS_OK == $response["status"]) {
                $class           = $response["data"];
                $auto_code_start = strpos($class, $this->auto_code_start);
                $auto_code_end   = strpos($class, $this->auto_code_end) + strlen($this->auto_code_end);
                
                $content = substr($class, 0, $auto_code_start);
                $content .= TemplateEngine::render("model_attributes_template",
                    [
                        "model"     => $model,
                        "parent"    => "model_blank",
                        "namespace" => $this->config["model_namespace"],
                    ]
                );
                
                $end_of_class = ltrim(substr($class, $auto_code_end, strlen($class)));;
                if ($end_of_class != "}")
                    $content .= "   ";
                
                $content .= ltrim(substr($class, $auto_code_end, strlen($class)));
            }
            else {
                $model["product_interface"] = $model["is_product_class"] ? ", ProductInterface" : "";
                $content                    = "<?php
                
" . TemplateEngine::render("model_attributes_template",
                        [
                            "model"     => $model,
                            "parent"    => "model_template",
                            "namespace" => $this->config["model_namespace"],
                        ]
                    );
                
                $new_models++;
            }
            
            $file_reader->create_file($model["class_name"], $content);
            $models[$key] = $model;
        }
        
        echo TemplateEngine::render("output",
            [
                "schema"     => $this->config["database"]["database"],
                "models"     => $models,
                "new_models" => $new_models,
            ]
        );
    }
    
    private function underscore_to_camelcase($model_name) {
        $model_name      = strtolower($model_name);
        $positions       = Utilities::get_all_positions("_", $model_name);
        $camel_case_name = "";
        
        $pointer = 0;
        foreach ($positions as $key => $position) {
            $camel_case_name .= ucfirst(substr($model_name, $pointer, $position - $pointer));
            $pointer         = $position + 1;
        }
        
        $camel_case_name .= ucfirst(substr($model_name, $pointer, strlen($model_name)));
        
        return $camel_case_name;
    }
    
    private function get_models_from_database() {
        $database_config = $this->config["database"];
        $database_name   = $database_config["database"];
        
        $base_path       = $this->config["base_path"];
        $view_directory  = "{$base_path}/core/database/generate/template";
        $cache_directory = "{$base_path}/core/database/generate/template/cache";
        
        // Create Blade handler
        App::bind("blade", new Blade($view_directory, $cache_directory));
        
        try {
            $statement = $this->pdo->prepare("SELECT TABLE_NAME
                FROM information_schema.tables
                WHERE TABLE_SCHEMA = '{$database_name}'"
            );
            $statement->execute();
            $tables = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            $models = [];
            foreach ($tables as $table) {
                $statement = $this->pdo->prepare("SELECT TABLE_SCHEMA, COLUMN_NAME, ORDINAL_POSITION, COLUMN_DEFAULT, IS_NULLABLE, DATA_TYPE, COLUMN_TYPE, EXTRA
                    FROM information_schema.columns
                    WHERE TABLE_NAME = '{$table["TABLE_NAME"]}'
                    ORDER BY ORDINAL_POSITION ASC"
                );
                $statement->execute();
                $columns = $statement->fetchAll(PDO::FETCH_ASSOC);
                
                $keys = [];
                $statement = $this->pdo->prepare("SHOW KEYS FROM {$table["TABLE_NAME"]} WHERE Key_name = 'PRIMARY'");
                $statement->execute();
                foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $key) {
                    $keys[] = $key["Column_name"];
                }
                
                $attributes = [];
                foreach ($columns as $column) {
                    $attributes[] = [
                        "table_schema"     => $column["TABLE_SCHEMA"],
                        "table_name"       => $table["TABLE_NAME"],
                        "column_name"      => $column["COLUMN_NAME"],
                        "ordinal_position" => $column["ORDINAL_POSITION"],
                        "default"          => $column["COLUMN_DEFAULT"],
                        "is_nullable"      => $column["IS_NULLABLE"],
                        "data_type"        => $this->convert_column_type($column["DATA_TYPE"]),
                        "type"             => $column["COLUMN_TYPE"],
                        "extra"            => $column["EXTRA"],
                    ];
                }
                
                $models[$table["TABLE_NAME"]] = [
                    "name"    => $table["TABLE_NAME"],
                    "columns" => $attributes,
                    "keys"    => $keys,
                ];
            }
            
            return $models;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        
        return [];
    }
    
    private function convert_column_type($type) {
        switch (strtolower(explode("(", $type)[0])) {
            case "text":
            case "varchar":
                return "string";
                break;
            case "timestamp":
                return "DateTime";
                break;
            case "double":
                return "float";
                break;
            case "int":
            case "tinyint":
                return "integer";
                break;
        }
        
        return $type;
    }
}