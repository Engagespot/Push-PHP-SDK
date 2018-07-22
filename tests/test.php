<?php
/**
 * Created by PhpStorm.
 * User: anands
 * Date: 29/06/16
 * Time: 12:51 PM
 */

require '../autoload.php';

use \Engagespot\EngagespotPush;


EngagespotPush::initialize('SITEKEY','APIKEY');

$data = ["campaignName" => 'Hello', "title" => "From SDK", "message" => "This is from SDK!", "link" => "http://google.com", "icon" => "http://engagespot.co/blog/wp-content/uploads/2017/02/wpengage.jpg"];

EngagespotPush::setMessage($data);

EngagespotPush::addIdentifiers(array('identifier'));

    
    EngagespotPush::send();
