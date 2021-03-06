<?php

declare(strict_types=1);

namespace App;

use App\Producer\Producer;
use App\Producer\ProducerInterface;
use DI\Container;
use DI\ContainerBuilder;
use DI\Definition\Reference;
use Dotenv\Dotenv;
use JMS\Serializer\Serializer;
use function DI\autowire;
use function DI\create;
use function DI\factory;
use function DI\get;

class App
{
    private Dotenv $env;

    private Container $container;

    public function __construct()
    {
        $this->env = Dotenv::createImmutable('./');
        $this->env->load();

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
        ];

        foreach ($definitionsSources as $definitions) {
            $containerBuilder->addDefinitions($definitions);
        }

        require_once('./config/services.php');

        try {
            $this->container = $containerBuilder->build();
        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
            exit(1);
        }
    }

    public function getContainer(): Container
    {
        return $this->container;
    }

    public static function env($key, $default)
    {
        $env = Dotenv::createImmutable('./');
        $env->load();

        return $_ENV[$key] ?? $default;
    }
}
