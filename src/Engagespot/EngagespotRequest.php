<?php
/**
 * Created by PhpStorm.
 * User: anands
 * Date: 29/06/16
 * Time: 11:48 AM
 */

namespace Engagespot;

use Exception;

class EngagespotRequest
{
    private static $serverUrl = "https://api.engagespot.co";

    private static $internalAPIUrl = "https://internalapi.engagespot.co";

    private static $body;

    private static $endPoint;

    private static $apiVersion = '2';

    public static function setBody($data){
        self::$body = $data;
    }

    public static function setEndPoint($data){
        self::$endPoint = $data;
    }

    public static function _request($key){

        if(!isset(self::$body) || !isset(self::$endPoint)){
            throw new Exception('Body or Endpoint not set');
        }else {

            $ch = curl_init();

            curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-Type: application/json","Api-Key: $key"));
            curl_setopt($ch, CURLOPT_URL, self::$serverUrl . '/' .self::$apiVersion.'/'. self::$endPoint);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, self::$body);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            
            $server_output = curl_exec($ch);

            curl_close($ch);

            $json = json_decode($server_output,true);


            if($json['status'] == 'ok'){
                return true;
            }else{
                throw new Exception($json['message']);
            }
        }
    }


    public static function _internalRequest(){

        if(!isset(self::$body) || !isset(self::$endPoint)){
            throw new Exception('Body or Endpoint not set');
        }else {

            $ch = curl_init();


            curl_setopt($ch, CURLOPT_URL, self::$internalAPIUrl.'/'.self::$endPoint);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, self::$body);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            /*
            print_r(self::$body);
            die();
            */
            $server_output = curl_exec($ch);

            //echo $server_output;
            //die();

            curl_close($ch);

            $json = json_decode($server_output,true);

            if($json['status'] == 'ok'){
                return true;
            }else{
                throw new Exception($json['message']);
            }
        }
    }
}