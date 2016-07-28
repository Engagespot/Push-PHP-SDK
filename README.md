# Engagespot PHP SDK V1

PHP wrapper for Engagespot API V1.

### Version
1.0

### Installation

To load this SDK to your PHP project, use the autoload script

```sh
require '/path/to/autoload.php';

use \Engagespot\EngagespotPush;

EngagespotPush::initialize('SITE_KEY','API_KEY');
?>
```

### Sending Push Notification

To send a push notification to all subscribers.

```sh
<?php

$data = ["title" => "From SDK", 
"message" => "This is from SDK!", 
"link" => "http://someurl.com", 
"icon" => "http://engagespot.co/logo.png"];

EngagespotPush::setMessage($data);
EngagespotPush::send();

?>
```


### Checking Whether User has Subscribed to Push

To check whether the current user has subscribed for push notifications from your website.
```sh
<?php

if(EngagespotPush::isPushSubscribed()){
    //User has subscribed
}else{
    //User donot have an active subscription
}

?>
```

### Sending Push to Selected Subscribers

If you want to send notification to few subscribers only, then use addSubscribers() method before calling send()

```sh
<?php

Engagespot::addSubscribers(array("user_hash", "user_hash"));

?>
```

### Sending Push to Selected Segments

If you want to send notification to few segmets only, then use addSegments() method before calling send()

```sh
<?php

Engagespot::addSegments(array("segment_identifier", "segment_identifier"));

?>
```

### Sending Push to Selected Mapping IDS

If you want to send notification to few mapping IDs only, then use addMappingIds() method before calling send()

```sh
<?php

Engagespot::addMappingIds(array("id1", "id2"));

?>
```

### Map an ID to Current Push Subscriber
You can map some ids with the current push subscriber so that you can send notifications to particular mapping IDs later.

For example, you can map your internal users id with a push subscriber.

```sh
<?php

Engagespot::setMapId($id);

?>
```
