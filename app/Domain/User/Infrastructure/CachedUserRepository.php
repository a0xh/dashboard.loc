<?php declare(strict_types=1);

namespace App\Domain\User\Infrastructure;

use App\Domain\User\Domain\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\{Str, Collection};

class CachedUserRepository implements UserRepositoryInterface
{
    protected const TTL = 1440;
    private const KEY = ['user'];

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

        if ($this->cache->has(Str::of('users'))) {
            $this->cache->pull(Str::of('users'));
        }

        return $createUser;
    }

    public function updateUser(User $user, array $data): bool
    {
        $updateUser = $this->userRepository->updateUser($user, $data);

        $cleanCache = collect(self::KEY);
        $cache = $this->cache;

        $cleanCache->each(function ($item) use($cache, $user) {
            if ($cache->has($item . '_' . $user->id)) {
                return $cache->pull(Str::of($item)->append('_')->finish($user->id));
            }
        })->each(function($item) use($cache) {
            if ($cache->has($item . 's')) {
                return $cache->pull(Str::of($item)->finish('s'));
            }
        });

        return $updateUser;
    }

    public function deleteUser(User $user): bool
    {
        $deleteUser = $this->userRepository->deleteUser($user);

        foreach (self::KEY as $key) {
            if ($this->cache->has(Str::of($key)->append('_')->finish($user->id))) {
                $this->cache->forget(Str::of($key)->append('_')->finish($user->id));
            }
            
            if ($this->cache->has($key . 's')) {
                $this->cache->forget(Str::of($key)->finish('s'));
            }
        }

        return $deleteUser;
    }
}
