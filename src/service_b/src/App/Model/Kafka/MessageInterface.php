<?php

declare(strict_types=1);

namespace App\Model\Kafka;

use JsonSerializable;

interface MessageInterface extends JsonSerializable
{
    public function getId(): int;

    public function getMessage(): string;

    public function setMessage(string $message): void;

    public function appendMessage(string $tail): void;
}
