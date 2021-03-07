<?php

declare(strict_types=1);

namespace App\Command;

use Psr\Container\ContainerInterface;

class CommandHandler
{
    /**
     * @var array|Command[]
     */
    private array $commands = [
        ListCommand::class  => null,
        RunConsumerA::class => null,
        RunConsumerB::class => null,
    ];

    public static function make(ContainerInterface $container): self
    {
        $handler = new self();
        foreach ($handler->commands as $className => $placeholder) {
            if (!$container->has($className)) {
                throw new \RuntimeException($className . ' must be registered as a service');
            }

            $handler->commands[$className::getCommandName()] = $container->get($className);
            unset($handler->commands[$className]);
        }

        return $handler;
    }

    public function handle(string $commandName, array $args = []): void
    {
        $registeredCommands = array_keys($this->commands);
        if (!in_array($commandName, $registeredCommands) || $commandName === ListCommand::getCommandName()) {
            $this->commands[ListCommand::getCommandName()]->execute($this->commands);
            return;
        }

        $this->commands[$commandName]->execute($args);
    }
}
