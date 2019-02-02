<?php
namespace AppBundle\Service;

use AppBundle\Interfaces\HttpClientInterface;
use AppBundle\Service\ConnectorService;

class TimeBenchmarkService{
	private $timeStart;
	private $timeStop;
	private $result;
	private $connectorService;

    public function __construct(ConnectorService $connectorService) {
        $this->connectorService = $connectorService;
    }

    public function getLoadingSpeed($url) {
        $this->init();
        $this->start();

        $response = $this->connectorService->getWebsite($url);

        $this->stop();

        return $this->getResult();
    }

    public function init() {
    	$this->timeStart = null;
    	$this->timeStop = null;
    	$this->result = null;
    }

    public function compareResults($time1, $time2) {
        $message = null;

        if ($time1 > $time2) {
            $message =  'First URL was loading slower by: '.($time1-$time2);
        }

        if ($time2 > $time1) {
            $message = 'Second URL was loading slower by: '.($time2-$time1);
        }

        return $message;
    }
	
	public function start() {
		$this->timeStart = microtime(true);
	}

	public function stop() {
		$this->timeStop= microtime(true);
	}

	public function getResult() {
		return $this->timeStop - $this->timeStart;
	}
}