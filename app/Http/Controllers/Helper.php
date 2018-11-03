<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Helper extends Controller
{
    /**
     * method to remove headers from json returned during api call using the wrapper 
     * 
     * @param json //json response 
     * @return status //return status string  
     */
    public function curlHeaderStatus($json){
        $ch = curl_init($json); 
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($json, 0, $header_size); 
        $body = substr($json, $header_size); 
        $content = strstr($body, '{');
        $decoded = json_decode($content, true);
        $status = $decoded['status'];

        return $status;
    }

    /**
     * this method just parse the json response and returns the error 
     * 
     * @param json //json response 
     * @return error // return the error string
     */
    public function curlHeaderError($json){
        $ch = curl_init($json); 
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($json, 0, $header_size); 
        $body = substr($json, $header_size); 
        $content = strstr($body, '{');
        $decoded = json_decode($content, true);
        $error = $decoded['error'];

        return $error;
    }
}
