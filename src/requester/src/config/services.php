<?php

use App\Client\BrokerClient;
use function DI\create;

return [
    \GuzzleHttp\ClientInterface::class => create(\GuzzleHttp\Client::class)->constructor([]),
    BrokerClient::class => create(BrokerClient::class)->constructor(\DI\get(\GuzzleHttp\Client::class), ['url' => 'http://nginx']),
];