<?php

namespace core\database\generate;

use core\App;

class FileReader {
    const STATUS_ERROR          = "ERROR";
    const STATUS_OK             = "OK";
    const STATUS_NO_FILE        = "NO_FILE";
    const STATUS_FILE_NOT_FOUND = "FILE_NOT_FOUND";
    
    private $model_directory;
    private $model_namespace;
    
    public function __construct() {
        $this->model_directory = App::get("config")["model_directory"];
        $this->model_namespace = App::get("config")["model_namespace"];
    }
    
    public function get_file_content($filename = null, $directory = null, $ttl = 10) {
        if ( ! $filename)
            return $this->error_message(InfoReader::STATUS_NO_FILE);
        
        $file_location = $this->model_directory . "/{$filename}.php";
        if ( ! is_null($directory) && $directory != "")
            $file_location .= "/{$directory}";
        
        if ( ! file_exists($file_location) || ! is_readable($file_location))
            return ["status" => FileReader::STATUS_FILE_NOT_FOUND];
        
        $file = fopen($file_location, "r", $this->model_directory);
        $data = fread($file, filesize($file_location));
        fclose($file);
        
        return ["status" => "OK", "data" => $data];
    }
    
    public function create_file($filename = null, $data = null, $directory = null) {
        if ( ! $filename || ! $data)
            return $this->error_message(InfoReader::STATUS_NO_FILE);
        
        // Set the correct file location
        $file_location = $this->model_directory;
        if ( ! is_null($directory) && $directory != "")
            $file_location .= "/{$directory}";
        
        $file_location .= "/{$filename}.php";
        
        // Create the file
        $handler = fopen($file_location, 'w');
        fwrite($handler, $data);
        fclose($handler);
        
        return ["status" => "OK", "data" => ""];
    }
    
    public function error_message($message = null) {
        if ( ! $message)
            $message = InfoReader::ERROR_OCCURRED;
        
        return [
            "status" => STATUS_ERROR,
            "data"   => $message,
        ];
    }
}