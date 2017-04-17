<?php

namespace app;

class Utilities {
    const STATUS_INVALID = "status_invalid";
    const STATUS_OK      = "status_ok";
    const METHOD         = "aes-256-cbc";
    const ACTION_ENCRYPT = "encrypt";
    const ACTION_DECRYPT = "encrypt";
    
    static private $api_key = "JvKnrQWPsThuJteNQAuH";
    static private $iv      = "212291939058b9b9a8f2af59.34139337";
    
    public static function get_all_positions($needle, $haystack, $offset = 0, &$results = array()) {
        $offset = strpos($haystack, $needle, $offset);
        if ($offset === false) {
            return $results;
        }
        else {
            $results[] = $offset;
        
            return Utilities::get_all_positions($needle, $haystack, ($offset + 1), $results);
        }
    }
    
    public static function get_word_positions($needle, $haystack) {
        return array_filter(
            str_word_count($haystack, 2), // The two ensures that this function returns a associated array.
            function($word) use ($needle) {
                return $word == $needle;
            }
        );
    }
    
    static public function generate_hash() {
        $unincrypted = uniqid(mt_rand(), true);
        
        return ["unencrypted" => $unincrypted, "encrypted" => Utilities::encrypt($unincrypted)];
    }
    
    static function encrypt($string) {
        $encrypt_method = "AES-256-CBC";
        $key            = hash("sha256", Utilities::$api_key);
        $iv             = substr(hash("sha256", Utilities::$iv), 0, 16);
        $output         = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output         = base64_encode($output);
        
        return str_replace("=", "__", $output);
    }
    
    static function decrypt($hash) {
        $hash           = str_replace("__", "=", $hash);
        $encrypt_method = "AES-256-CBC";
        $key            = hash("sha256", Utilities::$api_key);
        $iv             = substr(hash("sha256", Utilities::$iv), 0, 16);
        
        return openssl_decrypt(base64_decode($hash), $encrypt_method, $key, 0, $iv);
    }
    
    static public function concatenate(array $variables = array(), $seperator = " - ") {
        if (empty($variables))
            return "";
        
        $output = "";
        foreach ($variables as $variable) {
            if (empty($variable))
                continue;
            
            if ( ! empty($output))
                $output .= $seperator;
            
            $output .= $variable;
        }
        
        return $output;
    }
    
    static public function parseNewLinesJS($value = "") {
        return preg_replace('/\s\s+/', '<br />', $value);
    }
}