<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = App\App::make();

$repository = $app->getContainer()->get(\App\Repository\RequestRepository::class);
$id = $repository->getRequestMessageById(1);
var_dump($id);

$producerA = $app->getContainer()->get('producerA');
$producerA->publish(new \App\Model\Kafka\SimpleMessage(1, 'Hi'));

$consumerA = $app->getContainer()->get('consumerA');
$consumerA->consume();