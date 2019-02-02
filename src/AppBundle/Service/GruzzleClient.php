<?php
namespace AppBundle\Service;

use GuzzleHttp\Client;
use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use AppBundle\Interfaces\HttpClientInterface;

class GruzzleClient implements HttpClientInterface{
	private $client;

	public function __construct() {
		$this->client = new \GuzzleHttp\Client(['base_uri' => 'https://google.com/']);
	}

	public function getWebsite($url) {
		try {
			$request = $this->client->request('GET', $url, ['verify' => false]);	
		}
		catch(RequestException $e) {
  			return $e->getMessage();
		}
		
		return $request;
	}
}