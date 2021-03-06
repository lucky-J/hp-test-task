<?php

declare(strict_types=1);

namespace App\Model\Kafka;

class SimpleMessage implements MessageInterface
{
    private int $id;

    private string $message;

    public function __construct(int $id, string $message = '')
    {
        $this->id = $id;
        $this->message = $message;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function appendMessage(string $tail): void
    {
        $this->message .= $tail;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'message' => $this->message,
        ];
    }
}
