<?php declare(strict_types=1);

namespace App\Domain\User\Infrastructure;

use App\Domain\User\Domain\User;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class DecoratorUserRepository implements UserRepositoryInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    abstract public function findByUser(int $id): User;
    abstract public function getUser(int $count): LengthAwarePaginator;
}
