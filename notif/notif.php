<?php
class Notification{
	public $apiKey = "PLANETBIRU";
	public $password = "123456";
	public $group = "1234567890S";
	public $version = "1.0.0";
	public $pusherContext = "/notif/1.0.0/pusher";
	public $removerContext = "/notif/1.0.0/remover";
	public $serverAddress = "push.example.com";
	public $serverPort = 94;
	public $protocol = "http";
	public function createHeader($apiKey = NULL, $password = NULL, $group = NULL)
	{
		if($apiKey != NULL)
		{
			$this->apiKey = $apiKey;
		}
		if($password != NULL)
		{
			$this->password = $password;
		}
		if($group != NULL)
		{
			$this->group = $group;
		}
		$time = time(0);
		$token = sha1($time . $this->apiKey);
		$hash = sha1(sha1($this->password)."-".$token."-".$this->apiKey); 
		$headers = array
		(
			"Authorization: key=".$this->apiKey."&token=".$token."&hash=".$hash."&time=".$time."&group=".urlencode($this->group),
			"Content-Type: application/json"
		);
		return $headers;
	}
	public function __construct($apiKey = NULL, $password = NULL, $group = NULL, $version = NULL, $serverAddress = NULL, $serverPort = NULL, $protocol = NULL)
	{
		if($apiKey !== NULL)
		{
			$this->apiKey = $apiKey;
		}
		if($password !== NULL)
		{
			$this->password = $password;
		}
		if($group != NULL)
		{
			$this->group = $group;
		}
		if($version !== NULL)
		{
			$this->version = $version;
		}
		if($serverAddress !== NULL)
		{
			$this->serverAddress = $serverAddress;
		}
		if($serverPort !== NULL)
		{
			$this->serverPort = $serverPort;
		}
		if($protocol !== NULL)
		{
			if($protocol != "http" && $protocol != "https")
			{
				$protocol = "http";
			}
			$this->protocol = $protocol;
		}
		
		$this->pusherContext = "/notif/".$this->version."/pusher";
		$this->removerContext = "/notif/".$this->version."/remover";

	}
	public function push($registrationIds, $msg)
	{
		$data = array
		(
			'deviceIDs' => $registrationIds,
			'data'	  => $msg
		);
		$headers = $this->createHeader();
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->protocol."://".$this->serverAddress.":".$this->serverPort.$this->pusherContext);
		curl_setopt($ch, CURLOPT_POST, true );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $data ) );
		$result = curl_exec($ch );
		echo curl_error($ch);
		curl_close( $ch );
		return $result;
	}
	public function remove($data)
	{
		if(is_scalar($data))
		{
			$data = json_decode($data);
		}
		$headers = $this->createHeader();
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->protocol."://".$this->serverAddress.":".$this->serverPort.$this->removerContext);
		curl_setopt($ch, CURLOPT_POST, true );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $data ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		return $result;
	}
}

?>
