<?php
namespace AppBundle\Service;

use AppBundle\Interfaces\HttpClientInterface;

class ConnectorService{
	private $client;

    public function __construct(HttpClientInterface $client) {
        $this->client = $client;
    }
	
	public function getWebsite($url) {
		$website = $this->client->getWebsite($url);
		
		return $website;
	}
}