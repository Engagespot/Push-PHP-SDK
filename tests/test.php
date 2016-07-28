<?php
/**
 * Created by PhpStorm.
 * User: anands
 * Date: 29/06/16
 * Time: 12:51 PM
 */

require '../autoload.php';

use \Engagespot\EngagespotPush;


EngagespotPush::initialize('gfs67evgd287ebdvhs','gfs67evgd287ebdvhs');

$data = ["title" => "From SDK", "message" => "This is from SDK!", "link" => "http://google.com", "icon" => "http://engagespot.co/sqladmin/themes/pmahomme/img/logo_left.png"];

EngagespotPush::setMessage($data);

//EngagespotPush::addMappingIds(array('firefox','anandu'));

if(EngagespotPush::isPushSubscribed()){
    echo "yes";
    
    EngagespotPush::send();
}