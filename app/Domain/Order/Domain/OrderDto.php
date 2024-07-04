<?php

namespace App\Domain\Order\Domain;

class OrderDto
{
    public function __construct(
        private bool $status,
        private int $quantity,
        private ?array $data,
    ) {}

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getData(): ?array
    {
        return $this->data;
    }
}
