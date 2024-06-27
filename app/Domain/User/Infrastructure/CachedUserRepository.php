<?php

namespace App\Domain\User\Infrastructure;

use App\Domain\User\Domain\User;
use Illuminate\Cache\CacheManager;

class CachedUserRepository implements UserRepositoryInterface
{
    const TTL = 1440;

    public function __construct(
        protected EloquentUserRepository $user,
        protected CacheManager $cache
    ) {}

    public function findByUser(int $id): User
    {
        $findByUser = $this->cache->remember('user_' . $id, self::TTL, function () {
            return $this->user->findByUser($id);
        });

        return $findByUser;
    }

    public function getUser(int $count): LengthAwarePaginator
    {
        $findByUser = $this->cache->remember('users', self::TTL, function () {
            return $this->user->getUser($id);
        });

        return $findByUser;
    }

    public function createUser(array $data, int $roleId): bool
    {
        //
    }

    public function updateUser(User $user, array $data, int $roleId): bool
    {
        //
    }

    public function deleteUser(User $user): bool
    {
        //
    }
}
