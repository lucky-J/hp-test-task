<?php

declare(strict_types=1);

namespace App\Command;

use RuntimeException;

class ListCommand extends Command
{
    protected static string $name = 'list';
    protected static string $description = 'Shows list of registered command to the stdout';

    public function execute(array $args): void
    {
        $this->printHeader();
        /** @var Command $command */
        foreach ($args as $command) {
            echo sprintf(
                "%s \t %s%s",
                $command::getCommandName(),
                $command::getDescription(),
                PHP_EOL,
            );
        }

        echo PHP_EOL;
    }

    private function printHeader(): void
    {
        echo PHP_EOL;
        echo 'Broker Service';
        echo PHP_EOL;
        echo 'Registered commands:';
        echo PHP_EOL;
    }
}
