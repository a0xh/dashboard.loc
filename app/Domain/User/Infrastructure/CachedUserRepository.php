<?php declare(strict_types=1);

namespace App\Domain\User\Infrastructure;

use App\Domain\User\Domain\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Cache\CacheManager;

class CachedUserRepository implements UserRepositoryInterface
{
    protected const TTL = 1440;

    public function __construct(
        protected EloquentUserRepository $userRepository,
        protected CacheManager $cache
    ) {}

    public function findByUser(int $id): User
    {
        $findByUser = $this->cache->remember('user_' . $id, self::TTL, function() use($id) {
            return $this->userRepository->findByUser($id);
        });

        return $findByUser;
    }

    public function getUser(int $count): LengthAwarePaginator
    {
        $getUser = $this->cache->remember('users', self::TTL, function() use($count) {
            return $this->userRepository->getUser($count);
        });

        return $getUser;
    }

    public function createUser(array $data): bool
    {
        $createUser = $this->userRepository->createUser($data);

        if ($this->cache->has('users')) {
            $this->cache->pull('users');
        }

        return $createUser;
    }

    public function updateUser(User $user, array $data): bool
    {
        $updateUser = $this->userRepository->updateUser($user, $data);

        if ($this->cache->has('users')) {
            $this->cache->pull('users');
        }

        if ($this->cache->has('user_' . $user->id)) {
            $this->cache->forget('user_' . $user->id);
        }

        return $updateUser;
    }

    public function deleteUser(User $user): bool
    {
        $deleteUser = $this->user->deleteUser($user);

        if ($this->cache->has('users')) {
            $this->cache->forget('users');
        }

        if ($this->cache->has('user_' . $user->id)) {
            $this->cache->forget('user_' . $user->id);
        }

        return $deleteUser;
    }
}
