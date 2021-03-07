<?php

declare(strict_types=1);

namespace App;

use DI\Container;
use DI\ContainerBuilder;
use Exception;

class App
{
    private Container $container;

    public function __construct()
    {
        $this->buildDefinitions();
    }

    public static function make(): self
    {
        return new self();
    }

    private function buildDefinitions(): void
    {
        $containerBuilder = new ContainerBuilder();

        $definitionsSources = [
            require_once('./config/database.php'),
            require_once('./config/kafka.php'),
            require_once('./config/services.php')
        ];

        foreach ($definitionsSources as $definitions) {
            $containerBuilder->addDefinitions($definitions);
        }

        try {
            $this->container = $containerBuilder->build();
        } catch (Exception $e) {
            echo $e->getMessage() . PHP_EOL;
            exit(1);
        }
    }

    public function getContainer(): Container
    {
        return $this->container;
    }
}
