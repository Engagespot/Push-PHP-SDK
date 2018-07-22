# Engagespot PHP SDK V2

PHP wrapper for Engagespot API V2.

### Version
2.0

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

$data = ["campaignName" => "Test Campaign",
"title" => "From SDK", 
"message" => "This is from SDK!", 
"link" => "http://someurl.com", 
"icon" => "http://engagespot.co/logo.png"];

EngagespotPush::setMessage($data);
EngagespotPush::send();

?>
```

### Sending Push to identifiers

If you want to send notification selected identifiers (that you have already mapped through Javascript SDK) call addIdentifiers() method before calling send()

```sh
<?php

Engagespot::addIdentifiers(array("id1", "id2"));

?>
```