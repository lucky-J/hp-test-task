<?php

declare(strict_types=1);

namespace App\Command;

use RuntimeException;

abstract class Command
{
    protected static string $name = '';

    protected static string $description = '';

    public static function getCommandName(): string
    {
        return static::$name;
    }

    public static function getDescription(): string
    {
        return static::$description;
    }

    /**
     * @param mixed ...$args
     *
     * @throws RuntimeException
     */
    abstract public function execute(array $args): void;
}
