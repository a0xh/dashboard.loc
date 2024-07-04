<?php

namespace App\Domain\Order\Domain;

class OrderDto
{
    public function __construct(
        private bool $status,
    ) {}

    public function getStatus(): bool
    {
        return $this->status;
    }
}
