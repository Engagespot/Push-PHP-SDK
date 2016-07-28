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
    private static $mappingIds = [];
    private static $segments = [];

    private static $title;
    private static $message;
    private static $link;
    private static $icon;

    public static function initialize($siteKey,$apiKey){
        self::$siteKey = $siteKey;
        self::$apiKey = $apiKey;
    }

    public static function addSubscribers($userHash){
        if(!is_array($userHash)){
            throw new Exception('Subscribers should be passed as an array');
        }else {
            self::$subscribers = array_merge(self::$subscribers, $userHash);
        }
    }

    public static function addSegments($segmentIdentifiers){
        if(!is_array($segmentIdentifiers)){
            throw new Exception('Segments should be passed as an array');
        }else {
            self::$segments = array_merge(self::$segments, $segmentIdentifiers);
        }
    }


    public static function addMappingIds($mappingIds){
        if(!is_array($mappingIds)){
            throw new Exception('Mapping Ids should be passed as an array');
        }else {
            self::$mappingIds = array_merge(self::$mappingIds, $mappingIds);
        }
    }


    public static function setMessage($data){

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

        $body = array('notification_title' => self::$title, 'notification_message' => self::$message, 'notification_link' => self::$link
        , 'notification_icon' => self::$icon);

        if(!empty(self::$mappingIds)){
            $body['mapping_ids'] = json_encode(self::$mappingIds);
        }

        if(!empty(self::$subscribers)){
            $body['subscribers'] = json_encode(self::$subscribers);
        }

        if(!empty(self::$segments)){
            $body['segments'] = json_encode(self::$segments);
        }





        EngagespotRequest::setEndPoint('notifications');

        EngagespotRequest::setBody($body);

        return EngagespotRequest::_request(self::$apiKey);

    }
    
    public static function isPushSubscribed(){
        if(isset($_COOKIE['_webPushUserHash'])){
            return true;
        }else{
            return false;
        }
    }

    public static function setMapId($id){
        if(self::isPushSubscribed()){

            $body['userHash'] = $_COOKIE['_webPushUserHash'];
            $body['mappingId'] = $id;



            EngagespotRequest::setEndPoint('mapping');
            EngagespotRequest::setBody($body);
            return EngagespotRequest::_request(self::$apiKey);

        }else{
            throw new Exception('This user has not yet subscribed for push');
        }
    }

    
}