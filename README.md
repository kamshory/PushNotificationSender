# PushNotificationSender
Push notification sender

To get Push Notification Server and Push Notification Client, please open https://github.com/kamshory/PushNotificationServer and https://github.com/kamshory/PushNotificationClient 

## Constructor

```php
$notif = new Notification($apiKey, $apiPassword, $groupKey, $apiVersion, $serverAddress, $serverPort, $protocol);
```

### $apiKey
**apiKey** is your API key to send and get notification. Please remenber that Push Notification Server can serve multiple device and multiple sender.

### $apiPassword
**apiPassword** is API password to send notification to client. This password is difference from API password client for client.

### $groupKey
**groupKey** is the group of the receiver of the notification. For multiple user level application, API will use same device ID for difference user. Group key will filter the notification to deliver the notification to the right recipient.

### $apiVersion
**apiVersion** is the version of the API. Each version will process the incomming notification in the difference context.

### $serverAddress
**serverAddress** is the address of the server. Server address can be IP Address, domain or subdomain of the notification server.

**serverAddress** can be full URL which contains protocol, server host and server port. For example https://example.com:5555

### $serverPort
**serverPort** is the server port of the notification server.

### $protocol
**protocol** is the protocol to send notification. Protocol can be HTTP or HTTPS.

## Send Notification

### Method

```php
$inserted = $notif->push($recipients, $notification); 
```

### Parameters

#### $recipients
**recipients** is array contains the device ID of the recipients. 

#### $notification
**notification** is associted array of the notification listed bellow:
- title
  Title of the notification
- subtitle
  Subtitle of the notification
- message
  The content of the notification
- tickerText
  Ticker text of the notification
- uri
  URI attached with the notification
- clickAction
  Action to do on click
- type
  Type of the notification
- miscData
  Additional data attached with the notification. It can be a JOSN, XML or baae 64 encoded data
- color
  Color of the notification
- vibrate
  Vibrate of the notification
- sound
  Sound of the notification. It can be type or the path of the sound
- badge
  Badge of the notification. It can be type or the path of the badge
- largeIcon
  Large icon of the notification. It can be type or the path of the icon
- smallIcon
  Small icon of the notification. It can be type or the path of the icon
  
### Return Value

Array object. Each object contains notification ID and device ID

## Delete Notification

Sometime pusher need to delete notification sent to the recipient for an reason. Pusher can ask the server and application to delete the notification.

### Method
```php
$deleted = $notif->remove($pairs);
```
### Parameters
- pairs
  pairs is array object contains notification ID an device ID

### Return Value
Array object. Each object contains notification ID and device ID

## Example
```php
<?php
include "notif/notif.php";
$notif = new Notification("PLANETBIRU", "0987654321", "1234567890S", "1.0.0", "push.example.com", 94, "http");
// or 
// $notif = new Notification("PLANETBIRU", "0987654321", "1234567890S", "1.0.0", "http://push.example.com:94");
$miscData = array('nama'=>'Kamshory', 'alamat'=>'Jakarta Barat', 'telpon'=>'081111111111');
$msg = array
(
	'message'      => 'Halo Kamshory, pesan ini dikirim '.date("j F Y H:i:s"),
	'title'        => 'Pemberitahuan Ujian',
	'subtitle'     => 'This is a subtitle. subtitle',
	'tickerText'   => 'Ticker text here... Ticker text here... Ticker text here..',
	'uri'          => 'https://planetbiru.com/kamshory',
	'clickAction'  => 'open-url',
	'type'         => 'info',
	'miscData'     => $miscData,
	'clickAction'  => 'open-url',
	'color'        => '#FF5599',
	'vibrate'      => '200 0 200 400 0',
	'sound'        => 'sound1.wav',
	'badge'        => 'tameng1.png',
	'largeIcon'    => 'large_icon.png',
	'smallIcon'    => 'small_icon.png'
);
$registrationIds = array("41fda1bcf6486301", "41fda1bcf6486302", "41fda1bcf6486303");
$inserted = $notif->push($registrationIds, $msg); 
$deleted = $notif->remove($inserted);
echo "INSERTED = $inserted<br>\r\n";
echo "REMOVED = $deleted<br>\r\n";
?>
```
