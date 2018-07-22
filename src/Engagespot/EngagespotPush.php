<?php
/**
 * Created by PhpStorm.
 * User: anands
 * Date: 29/06/16
 * Time: 11:37 AM
 */

namespace Engagespot;

use Engagespot\EngagespotRequest;
use Exception;


class EngagespotPush
{

    private static $siteId;
    private static $apiKey;
    private static $siteKey;
    private static $data;
    private static $subscribers = [];
    private static $identifiers = [];
    private static $segments = [];

    private static $campaignName;
    private static $title;
    private static $message;
    private static $link;
    private static $icon;

    public static function initialize($siteKey,$apiKey){
        self::$siteKey = $siteKey;
        self::$apiKey = $apiKey;
    }


    public static function addIdentifiers($identifiers){
        if(!is_array($identifiers)){
            throw new Exception('Identifiers should be passed as an array');
        }else {
            self::$identifiers = array_merge(self::$identifiers, $identifiers);
        }
    }


    public static function setMessage($data){

        if(!isset($data['campaignName'])){
            throw new Exception('campaignName is required');
        }else{
            self::$campaignName = $data['campaignName'];
        }

        if(!isset($data['title'])){
            throw new Exception('Title is required');
        }else{
            self::$title = $data['title'];
        }

        if(!isset($data['message'])){
            throw new Exception('Message is required');
        }else{
            self::$message = $data['message'];
        }

        if(!isset($data['link'])){
            throw new Exception('Link is required');
        }else{
            self::$link = $data['link'];
        }

        if(isset($data['icon'])){
            self::$icon = $data['icon'];
        }


    }

    public static function send(){

        $body = [];

        $body['campaign_name'] = self::$campaignName;
        $body['notification'] = array('title' => self::$title, 'message' => self::$message, 'url' => self::$link
        , 'icon' => self::$icon);

        if(!empty(self::$identifiers)){
            $body['send_to'] = 'identifiers';
            $body['identifiers'] = self::$identifiers;
        }else{
            $body['send_to'] = 'everyone';
        }



        EngagespotRequest::setEndPoint('campaigns');

        EngagespotRequest::setBody(json_encode($body,JSON_UNESCAPED_SLASHES));

        return EngagespotRequest::_request(self::$apiKey);

    }
    
    
}