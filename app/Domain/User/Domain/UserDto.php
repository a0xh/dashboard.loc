<?php declare(strict_types=1);

namespace App\Domain\User\Domain;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;

class UserDto
{
    public function __construct(
        private ?UploadedFile $media,
        private string $first_name,
        private ?string $last_name,
        private string $email,
        private string $password,
        private bool $status,
        private string $role_id,
        private ?array $data
    ) {}

    public function getMedia(): ?UploadedFile
    {
        return $this->media;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getHashPassword(): string
    {
        return Hash::make($this->password);
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getRoleId(): string
    {
        return $this->role_id;
    }

    public function getData(): ?array
    {
        return $this->data;
    }
}
