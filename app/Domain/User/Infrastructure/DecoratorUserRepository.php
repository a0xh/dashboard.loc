<?php declare(strict_types=1);

namespace App\Domain\User\Infrastructure;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Domain\User\Domain\User;

abstract class DecoratorUserRepository implements UserRepositoryInterface
{
    protected $userRepository;

    protected function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    abstract protected function findByUser(string $id): Collection;
    abstract protected function getUser(): LengthAwarePaginator;
}
