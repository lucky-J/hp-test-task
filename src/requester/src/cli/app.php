<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = App\App::make();

$client = $app->getContainer()->get(\App\Client\BrokerClient::class);

$client->request();