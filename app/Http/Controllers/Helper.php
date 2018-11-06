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

    /**
     * function to check if there is an internet connection, to be used in development only
     * 
     */
    function is_connected()
     {
       $connected = @fsockopen("www.google.com.gh", 80); 
        //website, port  (try 80 or 443)
       if ($connected){
            //action when connected
          fclose($connected);
          return true; 
       }else{
        return false; //action in connection failure
       }
    }
}
