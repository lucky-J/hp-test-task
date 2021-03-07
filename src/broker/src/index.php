<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = App\App::make();

$repository = $app->getContainer()->get(\App\Repository\RequestRepository::class);

if (isset($_GET['message']) && $_GET['message'] === 'Hi') {
    $id = $repository->storeRequest($_GET['message']);
    if (!$id) {
        send('Internal server error', 500);
    }
    send(['id' => $id], 202);

    /** @var \App\Producer\ProducerInterface $producer */
    $producer = $app->getContainer()->get('producerA');
    $producer->publish(new \App\Model\Kafka\SimpleMessage($id, $_GET['message']));
    return;
}

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] !== 0) {
    $retries = 0;
    $retriesMax = 3;
    $retryDelay = 0.5;
    $result = [];
    while ($retries < $retriesMax) {
        $record = $repository->getRequestRecordById($_GET['id']);
        if (isset($record['is_complete']) && $record['is_complete'] === true) {
            break;
        }

        $retries++;
        sleep($retryDelay);
    }
    send(['message' =>  $result['message']]);
    return;
}

function send($content, int $responseCode = 200)
{
    http_response_code($responseCode);
    headers_sent();
    if (is_string($content)){
        echo $content;
    } elseif (is_array($content)) {
        echo json_encode($content);
    }

    if (\function_exists('fastcgi_finish_request')) {
        fastcgi_finish_request();
    }
}



