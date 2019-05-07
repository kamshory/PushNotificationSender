<?php
include "notif/notif.php";
//$notif = new Notification("PLANETBIRU", "0987654321", "1234567890S", "1.0.0", "push.example.com", 93, "https");
$notif = new Notification("PLANETBIRU", "0987654321", "1234567890S", "1.0.0", "push.example.com", 94, "http");
$miscData = array('nama'=>'Kamshory', 'alamat'=>'Jakarta Barat', 'telpon'=>'081111111111');
$msg = array
(
	'message'      => 'Halo Kamshory, pesan ini dikirim '.date("j F Y H:i:s"),
	'title'        => 'Pemberitahuan Ujian',
	'subtitle'     => 'This is a subtitle. subtitle',
	'tickerText'   => 'Ticker text here... Ticker text here... Ticker text here..',
	'uri'          => 'http://planetedu.id/usermanual/',
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
$response = $notif->push($registrationIds, $msg); 
header("Content-Type: application/json");
if($response['success'])
{
	$inserted = json_encode($response['data']);
	
	//$deleted = $notif->remove($inserted);
	echo $inserted;
	//echo "REMOVED = $deleted<br>\r\n";
	
	
	// SELECT left(time_create, 19) as created, count(*) as num FROM `notification` WHERE 1 group by created order by num desc
}
else
{
	echo $response['message'];
}

?>
