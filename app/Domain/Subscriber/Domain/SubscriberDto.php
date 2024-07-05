<?php

namespace App\Domain\Subscriber\Domain;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;

class SubscriberDto
{
    public function __construct(
        private ?string $email,
        private ?bool $status,
        private ?array $data,
    ) {}

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function getData(): ?array
    {
        return $this->data;
    }
}
