<?php declare(strict_types=1);

namespace App\Domain\User\Infrastructure;

use App\Domain\User\Domain\{UserDto, User};

interface UserRepositoryInterface
{
    public function createUser(UserDto $data): bool;
    public function updateUser(User $user, UserDto $data): bool;
    public function deleteUser(User $user): bool;
}
