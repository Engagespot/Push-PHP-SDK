# Engagespot PHP SDK V2

PHP wrapper for Engagespot API V2.

### Version
2.0

### Installation

Via Composer

```sh
composer require engagespot/engagespot-php-sdk
```

If you donot want to use composer, you can load the autoload.php file directly.

```sh
require '/path/to/autoload.php';
```

Use the EngagespotPush Class from Engagespot namespace.
Initialize the SDK using your SITE_KEY and API_KEY.

```
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