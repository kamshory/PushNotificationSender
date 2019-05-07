<?php
class Notification{
	public $apiKey = "PLANETBIRU";
	public $password = "123456";
	public $group = "1234567890S";
	public $version = "1.0.0";
	public $pusherContext = "/notif/1.0.0/pusher";
	public $removerContext = "/notif/1.0.0/remover";
	public $createGroupContext = "/notif/1.0.0/create-group";
	public $serverAddress = "push.example.com";
	public $serverPort = 94;
	public $protocol = "http";
	public $appName = "Push Notification";
	public $appVersion = "1.0.0";
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
			"X-Authorization: key=".$this->apiKey."&token=".$token."&hash=".$hash."&time=".$time."&group=".urlencode($this->group),
			"X-Application-Name: ".$this->appName,
			"X-Application-Version: ".$this->appVersion,
			"Content-Type: application/json"
		);
		return $headers;
	}
	public function __construct($apiKey = NULL, $password = NULL, $version = NULL, $serverAddress = NULL, $serverPort = NULL, $protocol = NULL)
	{
		if($apiKey !== NULL)
		{
			$this->apiKey = $apiKey;
		}
		if($password !== NULL)
		{
			$this->password = $password;
		}
		if($version !== NULL)
		{
			$this->version = $version;
		}
		if($serverAddress !== NULL)
		{
			if(stripos($serverAddress, "://") !== false)
			{
				$parsed = parse_url($serverAddress);
				$this->protocol = $parsed['scheme'];
				$this->serverAddress = $parsed['host'];
				if(isset($parsed['port']))
				{
					$this->serverPort = $parsed['port'];
				}
				else
				{
					if($this->protocol == 'https')
					{
						$this->serverPort = 443;
					}
					else
					{
						$this->serverPort = 80;
					}
				}
			}
			else
			{
				$this->serverAddress = $serverAddress;
			}
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
		curl_setopt($ch, CURLOPT_USERAGENT, 'Planet Notification Pusher');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $data ) );		
		$response = curl_exec($ch);
		$err = curl_error($ch);
		curl_close( $ch );
		$result = array();
		if(!$err)
		{
			$result = array(
				'success'=>true,
				'data'=>json_decode($response),
				'message'=>''
				);
		}
		else
		{
			$result = array(
				'success'=>false,
				'data'=>null,
				'message'=>$err
				);
		}
		
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
		curl_setopt($ch, CURLOPT_USERAGENT, 'Planet Notification Pusher');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $data ) );
		$response = curl_exec($ch);
		$err = curl_error($ch);
		curl_close( $ch );
		$result = array();
		if(!$err)
		{
			$result = array(
				'success'=>true,
				'data'=>json_decode($response),
				'message'=>''
				);
		}
		else
		{
			$result = array(
				'success'=>false,
				'data'=>null,
				'message'=>$err
				);
		}
		
		return $result;
	}
	public function createGroup($data)
	{
		if(is_scalar($data))
		{
			$data = json_decode($data);
		}
		$headers = $this->createHeader();
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->protocol."://".$this->serverAddress.":".$this->serverPort.$this->createGroupContext);
		curl_setopt($ch, CURLOPT_POST, true );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt($ch, CURLOPT_USERAGENT, 'Planet Notification Pusher');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $data ) );
		$response = curl_exec($ch);
		$err = curl_error($ch);
		curl_close( $ch );
		$result = array();
		if(!$err)
		{
			$result = array(
				'success'=>true,
				'data'=>json_decode($response),
				'message'=>''
				);
		}
		else
		{
			$result = array(
				'success'=>false,
				'data'=>null,
				'message'=>$err
				);
		}
		
		return $result;
	}
}

?>
