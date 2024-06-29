<?php declare(strict_types=1);

namespace App\Domain\User\Infrastructure;

use App\Domain\User\Domain\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function findByUser(int $id): User;
    public function getUser(int $count): LengthAwarePaginator;
    public function createUser(array $data): bool;
    public function updateUser(User $user, array $data): bool;
    public function deleteUser(User $user): bool;
}
