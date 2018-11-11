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
