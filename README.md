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

