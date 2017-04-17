<?php

namespace core\database;

use app\model\BaseModelInterface;
use app\model\Laptop;
use app\model\BaseModelTrait;
use app\Utilities;
use core\App;
use core\Router;
use Exception;
use PDO;
use PDOStatement;
use ReflectionClass;

class QueryBuilder {
    const QUERY_OPTION_SELECT_ADD      = "columns";
    const QUERY_OPTION_JOIN_ADD        = "join";
    const QUERY_OPTION_WHERE           = "where";
    const QUERY_OPTION_SORT            = "sort";
    const QUERY_OPTION_LIMIT           = "limit";
    const QUERY_OPTION_OFFSET          = "offset";
    const QUERY_OPTION_VARIABLES       = "variables";
    const QUERY_OPTION_RESULT_TYPE     = "result_type";
    const QUERY_OPTION_RESULT_TYPES    = [
        QueryBuilder::QUERY_OPTION_RESULT_SINGULAR,
        QueryBuilder::QUERY_OPTION_RESULT_MULTIPLE,
    ];
    const QUERY_OPTION_RESULT_SINGULAR = "result_singular";
    const QUERY_OPTION_RESULT_MULTIPLE = "result_multiple";
    
    /**
     * @var PDO $pdo
     */
    private $pdo;
    
    /**
     * @var BaseModelInterface $model
     */
    private $model;
    
    /**
     * @var array
     */
    private $query_options = [
        QueryBuilder::QUERY_OPTION_SELECT_ADD  => [],
        QueryBuilder::QUERY_OPTION_JOIN_ADD    => [],
        QueryBuilder::QUERY_OPTION_WHERE       => [],
        QueryBuilder::QUERY_OPTION_SORT        => [],
        QueryBuilder::QUERY_OPTION_LIMIT       => null,
        QueryBuilder::QUERY_OPTION_OFFSET      => null,
        QueryBuilder::QUERY_OPTION_VARIABLES   => [],
        QueryBuilder::QUERY_OPTION_RESULT_TYPE => QueryBuilder::QUERY_OPTION_RESULT_MULTIPLE,
    ];
    
    private $join_types = [
        "inner" => "INNER JOIN",
        "left"  => "LEFT JOIN",
        "right" => "RIGHT JOIN",
    ];
    
    private $where_types = [
        "and" => "AND",
        "or"  => "OR",
    ];
    
    private $variable_types = [
        "parameter",
        "value",
        "column",
    ];
    
    public function __construct(PDO $pdo = null) {
        if (is_null($pdo))
            $pdo = Connection::make();
        
        $this->pdo = $pdo;
    }
    
    public function query($table = null, $parameters = []) {
        if ( ! is_null($table))
            $this->model = $this->get_class($table);
        
        if (is_null($this->model))
            throw new Exception("Invalid parameters given.");
        
        $this->are_query_options_valid($parameters);
        try {
            $sql = "{$this->parse_select_statement()} FROM {$this->model->table()}";
            
            if ( ! empty($this->query_options[QueryBuilder::QUERY_OPTION_JOIN_ADD])) {
                foreach ($this->query_options[QueryBuilder::QUERY_OPTION_JOIN_ADD] as $join_option) {
                    $sql .= " {$join_option["type"]} {$join_option["table"]} AS {$join_option["alias"]} ON {$join_option["join_statement"]}";
                }
            }
            
            if ( ! empty($this->query_options[QueryBuilder::QUERY_OPTION_WHERE])) {
                foreach ($this->query_options[QueryBuilder::QUERY_OPTION_WHERE] as $key => $condition) {
                    if (0 == $key)
                        $condition["type"] = "WHERE";
                    
                    $sql .= " {$condition["type"]} {$condition["condition"]}";
                }
            }
            
            $statement = $this->parse_variables($this->pdo->prepare($sql));
            $statement->execute();
            
            //            $statement->setFetchMode(PDO::FETCH_CLASS, $this->model->class());
            
            return $this->fetch_results($statement);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    public function basic_query($table, $sql) {
        $this->model = $this->get_class($table);
        $statement   = $this->parse_variables($this->pdo->prepare($sql));
        $statement->execute();
        
        return $this->fetch_results($statement);
    }
    
    public function insert(BaseModelInterface $table = null, array $parameters = []) {
        if ( ! is_null($table))
            $this->model = $this->get_class($table);
        
        if (is_null($this->model))
            throw new Exception("Invalid parameters given.");
        
        $this->are_query_options_valid($parameters);
        $values = $this->model->column_values();
        $sql    = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $table->table(),
            implode(", ", array_keys($values)),
            ":" . implode(", :", array_keys($values))
        );
        
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($values);
            
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            dump($values);
            die($e->getMessage());
        }
    }
    
    public function update(BaseModelInterface $table = null, array $parameters = []) {
        if ( ! is_null($table))
            $this->model = $this->get_class($table);
        
        if (is_null($this->model))
            throw new Exception("Invalid parameters given.");
        
        $this->are_query_options_valid($parameters);
        $values     = $this->model->column_values();
        $set_values = [];
        foreach ($this->model->column_values() as $column => $value) {
            $set_values[] = "{$column} = :{$column}";
        }
        
        $set_values = Utilities::concatenate($set_values, ", ");
        
        $keys = "";
        foreach ($this->model->keys() as $key) {
            $prefix = "AND";
            if (empty($keys))
                $prefix = "WHERE";
            
            $keys .= "{$prefix} {$key} = :primary_key_{$key} ";
            $values["primary_key_{$key}"] = $this->model->get($key);
        }
        
        $sql = trim(sprintf(
            "UPDATE %s SET %s %s",
            $table->table(),
            $set_values,
            $keys
        ));
        
        try {
            $statement = $this->pdo->prepare($sql);
            if ( ! $statement->execute($values))
                throw new Exception("Could not update '{$this->model->class()}' model.'");
            
            return true;
        } catch (PDOException $e) {
            dump($values);
            die($e->getMessage());
        }
    }
    
    public function delete(BaseModelInterface $table = null, array $parameters = []) {
        if ( ! is_null($table))
            $this->model = $this->get_class($table);
        
        if (is_null($this->model))
            throw new Exception("Invalid parameters given.");
        
        $keys = "";
        foreach ($this->model->keys() as $key) {
            if ( ! empty($keys))
                $keys .= "AND ";
            
            $keys .= "{$key} = :primary_key_{$key} ";
            $values["primary_key_{$key}"] = $this->model->get($key);
        }
        
        $sql = trim(sprintf(
            "DELETE FROM %s WHERE %s",
            $table->table(),
            $keys
        ));
        
        try {
            $statement = $this->pdo->prepare($sql);
            if ( ! $statement->execute($values))
                throw new Exception("Could not update '{$this->model->class()}' model.'");
            
            return true;
        } catch (PDOException $e) {
            dump($values);
            die($e->getMessage());
        }
    }
    
    /**
     * @param $class_name
     *
     * @return BaseModelInterface
     * @throws Exception
     */
    public function get_class($class_name) {
        if (is_object($class_name)) {
            if ( ! array_key_exists(BaseModelTrait::class, class_uses($class_name))) {
                $model_name = (is_object($class_name) ? (new ReflectionClass($class_name))->getShortName() : ucfirst($class_name));
                throw new Exception("{$model_name} model does not exist");
            }
            
            return $class_name;
        }
        
        if (class_exists($class_name))
            return new $class_name();
        
        $class_name = App::get("config")["model_namespace"] . "\\" . ucfirst($class_name);
        if (class_exists($class_name))
            return new $class_name();
        
        throw new Exception((is_object($class_name) ? (new ReflectionClass($class_name))->getShortName() : ucfirst($class_name)) . " model does not exist");
    }
    
    public function set_table($table) {
        $this->model = $this->get_class($table);
        
        return $this;
    }
    
    public function add_select_statement(...$select_statements) {
        if (0 == count($select_statements))
            throw new Exception("Invalid variable paratemers provided.");
        
        foreach ($select_statements as $key => $select_statement)
            $this->query_options[QueryBuilder::QUERY_OPTION_SELECT_ADD][] = $select_statement;
        
        return $this;
    }
    
    public function add_join($model, $join_statement, array $options = []) {
        $class            = $this->get_class($model);
        $join_model       = $class->class();
        $join_table       = $class->table();
        $join_model_alias = $join_table;
        $join_type        = $this->join_types["inner"];
        
        if (array_key_exists("alias", $options))
            $join_model_alias = $options["alias"];
        
        if (array_key_exists("type", $options)) {
            if ( ! array_key_exists($options["type"], $this->join_types))
                throw new Exception("{$options["type"]} join type is not supported.");
            
            $join_type = strtoupper($this->join_types[$options["type"]]);
        }
        
        $this->query_options[QueryBuilder::QUERY_OPTION_JOIN_ADD][] = [
            "model"          => $join_model,
            "table"          => $join_table,
            "join_statement" => $join_statement,
            "alias"          => $join_model_alias,
            "type"           => $join_type,
        ];
        
        return $this;
    }
    
    public function add_where($condition, $type = "and") {
        if (empty($condition) || ! array_key_exists($type, $this->where_types))
            throw new Exception("Invalid variable paratemers provided.");
        
        $this->query_options[QueryBuilder::QUERY_OPTION_WHERE][] = ["condition" => $condition, "type" => $this->where_types[$type]];
        
        return $this;
    }
    
    public function set_limit($limit, $offset = null) {
        $this->query_options[QueryBuilder::QUERY_OPTION_LIMIT] = $limit;
        if ( ! empty($offset))
            $this->query_options[QueryBuilder::QUERY_OPTION_OFFSET] = $offset;
        
        return $this;
    }
    
    public function set_offset($offset) {
        $this->query_options[QueryBuilder::QUERY_OPTION_OFFSET] = $offset;
        
        return $this;
    }
    
    public function add_variables($key, $variable_option, $type = "parameter") {
        if ( ! in_array($type, $this->variable_types))
            throw new Exception("Invalid variable paratemers provided.");
    
        $this->query_options[QueryBuilder::QUERY_OPTION_VARIABLES][] = ["key" => $key, "variable" => $variable_option, "type" => $type];
        
        return $this;
    }
    
    public function set_result_type(string $result_type) {
        if ( ! in_array($result_type, QueryBuilder::QUERY_OPTION_RESULT_TYPES))
            throw new Exception("Invalid parameter given.");
        
        $this->query_options[QueryBuilder::QUERY_OPTION_RESULT_TYPE] = $result_type;
        
        return $this;
    }
    
    private function parse_variables(PDOStatement $statement) {
        if ( ! array_key_exists(QueryBuilder::QUERY_OPTION_VARIABLES, $this->query_options)
            && empty($this->query_options[QueryBuilder::QUERY_OPTION_VARIABLES])
        )
            return;
        
        foreach ($this->query_options[QueryBuilder::QUERY_OPTION_VARIABLES] as $key => $variable) {
            if ( ! is_numeric($variable["key"]))
                $variable["key"] = ":{$variable["key"]}";
            
            switch ($variable["type"]) {
                case "column":
                    $statement->bindColumn($variable["key"], $variable["variable"]);
                    break;
                case "value":
                    $statement->bindValue($variable["key"], $variable["variable"]);
                    break;
                default:
                    $statement->bindParam($variable["key"], $variable["variable"]);
                    break;
            }
        }
        
        return $statement;
    }
    
    private function parse_select_statement() {
        if (empty($this->model->columns()))
            return "SELECT *";
        
        if (empty($this->query_options[QueryBuilder::QUERY_OPTION_SELECT_ADD])) {
            $columns          = [];
            $select_statement = "SELECT ";
            foreach ($this->model->columns() as $column => $attributes)
                $columns[] = "{$this->model->table()}.{$column} AS {$column}";
            
            $select_statement .= Utilities::concatenate($columns, ", ");
            if ( ! empty($this->query_options[QueryBuilder::QUERY_OPTION_JOIN_ADD])) {
                foreach ($this->query_options[QueryBuilder::QUERY_OPTION_JOIN_ADD] as $join_model) {
                    $columns = [];
                    $class   = $this->get_class($join_model["model"]);
                    foreach ($class->columns() as $column => $attributes)
                        $columns[] = "{$class->table()}.{$column} AS {$class->table()}_{$column}";
                    
                    $select_statement .= ", " . Utilities::concatenate($columns, ", ");
                }
            }
            
            return $select_statement;
        }
        
        return "SELECT " . Utilities::concatenate($this->query_options[QueryBuilder::QUERY_OPTION_SELECT_ADD], ", ");
    }
    
    private function fetch_results($statement) {
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        
        switch ($this->query_options[QueryBuilder::QUERY_OPTION_RESULT_TYPE]) {
            case QueryBuilder::QUERY_OPTION_RESULT_SINGULAR:
                return $this->fill_class($statement->fetch());
            default:
                $results       = [];
                $result_arrays = $statement->fetchAll();
                if (empty($result_arrays))
                    return $results;
                
                foreach ($result_arrays as $result) {
                    
                    if (false == $result)
                        dd($result_arrays);
                    
                    $results[] = $this->fill_class($result);
                }
                
                return $results;
        }
    }
    
    private function fill_class($result) {
        $class_name = $this->model->class();
        
        /**
         * @var BaseModelInterface $class
         */
        $class = new $class_name();
        if (empty($result))
            return false;
        
        foreach ($result as $column => $value) {
            $class->set($column, $value);
        }
        
        return $class;
    }
    
    public function add_query_option($query_options = []) {
        $this->areQueryOptionsValid($query_options);
        
        return;
    }
    
    private function are_query_options_valid($query_options = []) {
        $this->query_options = array_merge($query_options, $this->query_options);
        
        if (array_key_exists(QueryBuilder::QUERY_OPTION_SORT, $query_options)) {
            foreach ($query_options[QueryBuilder::QUERY_OPTION_SORT] as $key => $option) {
                if (is_numeric($key))   // No 'key' defined, which means that the value is the column
                    $this->query_options[QueryBuilder::QUERY_OPTION_SORT][] = [$option => "ASC"];
                else                    // A 'key' is defined, which means that the 'key' is the column and the value is the sort
                    $this->query_options[QueryBuilder::QUERY_OPTION_SORT][] = [$key => strtoupper($option)];
            }
        }
        
        if (array_key_exists(QueryBuilder::QUERY_OPTION_RESULT_TYPE, $query_options)
            && in_array($query_options[QueryBuilder::QUERY_OPTION_RESULT_TYPE], QueryBuilder::QUERY_OPTION_RESULT_TYPES)
        ) {
            $this->query_options[QueryBuilder::QUERY_OPTION_RESULT_TYPE] = $query_options[QueryBuilder::QUERY_OPTION_RESULT_TYPE];
        }
    }
}