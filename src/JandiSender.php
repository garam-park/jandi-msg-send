<?php

namespace Garam\Jandi;

use GuzzleHttp\Client;
use Structure\ArrayS;

class JandiSender {
	
	private $client;
	private $uri;
	private $connectInfo_check1;
	private $connectInfo_check2;

	function __construct($uri) {
		$this->client = new Client(['base_uri' => $uri]);
		$this->uri = $uri;
		$this->connectInfo_check1 = new ArrayS;
		$this->connectInfo_check2 = new ArrayS;
		$this->connectInfo_check1->setFormat([
				'title' => "string",
				'description' => "string"
		]);
		$this->connectInfo_check2->setFormat([
				'title' => "string",
				'description' => "string",
				'imageUrl' => "string",
		]);
	}

	public function sendSimpleMessage($message = "",$color = "#00AA89"){
		
		$body = [
			"body" => $message,
			"connectColor" => $color
		];

		$response = $this->client->request('POST', $this->uri, [
		    'headers' => [
		        'Content-Type' => 'application/json',
		        'Accept'     => 'application/vnd.tosslab.jandi-v2+json',
		    ],
		    'body' => json_encode($body)
		]);

		return $response;
	}

	public function sendDetailMessage($message ="" ,$connectInfos = [],$color = "#00AA89"){

		foreach ($connectInfos as $key => $connectInfo) {
			
			$check1 = (!$this->connectInfo_check1->check($connectInfo));
			$check2 = (!$this->connectInfo_check2->check($connectInfo));

			if($check1 && $check2)
					throw new \Exception("connectInfo Structure Exception.", 406);	
		}

		$body = [
			"body" => $message,
			"connectColor" => $color,
			"connectInfo" => $connectInfos,
		];

		$response = $this->client->request('POST', $this->uri, [
		    'headers' => [
		        'Content-Type' => 'application/json',
		        'Accept'     => 'application/vnd.tosslab.jandi-v2+json',
		    ],
		    'body' => json_encode($body)
		]);

		return $response;
	}

}