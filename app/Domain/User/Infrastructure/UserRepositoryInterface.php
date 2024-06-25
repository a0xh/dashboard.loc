<?php

namespace App\Domain\User\Infrastructure;

use App\Domain\User\Domain\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function findByUser(int $id): User;
    public function getUser(int $count): LengthAwarePaginator;
    public function createUser(array $data, int $roleId): bool;
    public function updateUser(User $user, array $data, int $roleId): bool;
    public function deleteUser(User $user): bool;
}
