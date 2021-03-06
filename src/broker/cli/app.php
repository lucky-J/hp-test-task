<?php

use App\Command\CommandHandler;

require_once __DIR__ . '/../vendor/autoload.php';

$app = App\App::make();

$handler = CommandHandler::make($app->getContainer());
if ($argc < 2) {
    $handler->handle('list', $argv);
    return;
}

list(, $command) = $argv;
$withArgs = false;
if ($argc > 2) {
    $withArgs = true;
    array_shift($argv);
    array_shift($argv);
}

$handler->handle($command, $argv);

return;