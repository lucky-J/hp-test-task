<?php

declare(strict_types=1);

namespace App\Client;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class BrokerClient
{
    private ClientInterface $client;
    private array $config;

    public function __construct(ClientInterface $client, array $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

    public function request()
    {
        $payload = ['message' => 'Hi'];
        try {
            $response = $this->client->request(
                'GET',
                $this->config['url'] . '?' . http_build_query($payload),
                [
                    'timeout' => 1
                ]
            );

            if ($response->getStatusCode() !== 202) {
                echo 'Invalid response' . PHP_EOL;
                return;
            }

            $result = json_decode($response->getBody()->getContents(), true);
            if (!$result || !isset($result['id']) || $result['id'] === 0) {
                echo 'Invalid response' . PHP_EOL;
                return;
            }
            $this->waitForComplete((int) $result['id']);

        } catch (\Throwable $exception) {
            echo 'No response' . PHP_EOL;
        }
    }

    private function waitForComplete(int $id): void
    {
        $promise = $this->client->requestAsync(
            'GET',
            $this->config['url'] . '?id=' . $id
        );

        $response = $promise->wait();
        if ($response instanceof ResponseInterface) {
            echo $response->getStatusCode() . PHP_EOL;
            echo $response->getBody()->getContents() . PHP_EOL;
        }
    }
}
