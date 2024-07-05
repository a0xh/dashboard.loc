<?php

namespace App\Domain\Setting\Domain;

class SettingPdo
{
    public function __construct(
        private string $key,
        private array $data,
    ) {}

    public function getKey(): string
    {
        return $this->key;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
