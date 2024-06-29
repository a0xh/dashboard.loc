<?php declare(strict_types=1);

namespace App\Domain\User\Infrastructure;

use App\Domain\User\Domain\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\{Str, Collection};

class CachedUserRepository implements UserRepositoryInterface
{
    private const TTL = 1440;

    public function __construct(
        public EloquentUserRepository $userRepository,
        public CacheManager $cache
    ) {}

    public function findByUser(int $id): User
    {
        $key = Str::of('user')->append('_')->finish($id);

        $findByUser = $this->cache->remember($key, self::TTL, function() use($id) {
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

        $cache = $this->cache;

        collect(['users'])->each(function ($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $createUser;
    }

    public function updateUser(User $user, array $data): bool
    {
        $updateUser = $this->userRepository->updateUser($user, $data);

        $cache = $this->cache;

        collect(['users'])->each(function ($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        collect(['user_'])->each(function($item) use($cache, $user) {
            if ($cache->has(Str::of($item)->finish($user->id))) {
                return $cache->forget(Str::of($item)->finish($user->id));
            }
        });

        return $updateUser;
    }

    public function deleteUser(User $user): bool
    {
        $deleteUser = $this->userRepository->deleteUser($user);

        $cache = $this->cache;

        collect(['users'])->each(function ($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        collect(['user_'])->each(function($item) use($cache, $user) {
            if ($cache->has(Str::of($item)->finish($user->id))) {
                return $cache->forget(Str::of($item)->finish($user->id));
            }
        });

        return $deleteUser;
    }
}
