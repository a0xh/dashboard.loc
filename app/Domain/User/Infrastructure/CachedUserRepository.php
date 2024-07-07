<?php declare(strict_types=1);

namespace App\Domain\User\Infrastructure;

use App\Domain\User\Domain\{User, UserDto};
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\{Str, Collection};

final class CachedUserRepository extends DecoratorUserRepository implements UserRepositoryInterface
{
    private const TTL = 1440;

    public function __construct(
        private readonly EloquentUserRepository $eloquentUserRepository,
        private readonly TransactionUserRepository $transactionUserRepository,
        private readonly CacheManager $cacheManager
    ) {}

    public function findByUser(string $id): Collection
    {
        $setKey = Str::of('user')->append('_')->finish($id);

        $findByUser = $this->cacheManager->remember($setKey, self::TTL, function() use($id) {
            return $this->eloquentUserRepository->findByUser($id);
        });

        return $findByUser;
    }

    public function getUser(): LengthAwarePaginator
    {
        $getUser = $this->cacheManager->remember('users', self::TTL, function() {
            return $this->eloquentUserRepository->getUser();
        });

        return $getUser;
    }

    public function createUser(UserDto $userDto): bool
    {
        $createUser = $this->transactionUserRepository->createUser($userDto);

        $this->cacheManager->pull('users');

        return $createUser;
    }

    public function updateUser(User $user, UserDto $userDto): bool
    {
        $updateUser = $this->transactionUserRepository->updateUser($user, $userDto);

        $this->cacheManager->pull('users');
        $this->cacheManager->pull(Str::of('user')->append('_')->finish($user->id));

        return $updateUser;
    }

    public function deleteUser(User $user): bool
    {
        $deleteUser = $this->transactionUserRepository->deleteUser($user);

        $this->cacheManager->forget('users');
        $this->cacheManager->forget(Str::of('user')->append('_')->finish($user->id));

        return $deleteUser;
    }
}
