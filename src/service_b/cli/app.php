<?php

use App\Command\CommandHandler;

require_once __DIR__ . '/../vendor/autoload.php';

$app = App\App::make();

$handler = CommandHandler::make($app->getContainer());
if ($argc < 2) {
    $handler->handle(\App\Command\ListCommand::getCommandName());
    return;
}

list(, $command) = $argv;
if ($argc > 2) {
    $argv = array_slice($argv, 0, 2);
}

$handler->handle($command, $argv);

return;