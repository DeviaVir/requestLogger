<?php

require_once __DIR__ . '/vendor/autoload.php';

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Application();

$app->match('{url}',
	function (Request $request) {
    	$logger = new Zend\Log\Logger;
		$writer = new Zend\Log\Writer\Stream(__DIR__ . '/info.log');
		$logger->addWriter($writer);

		$logger->log(
			Zend\Log\Logger::INFO, 
			'GET:' . json_encode($request->query->all()) . ';' .
			'POST:' . json_encode($request->request->all()) . ';'
		);

        return 'OK';
    }
)->assert('url', '.*');

$app->run();