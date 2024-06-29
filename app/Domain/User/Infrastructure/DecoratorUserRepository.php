<?php declare(strict_types=1);

namespace App\Domain\User\Infrastructure;

abstract class DecoratorUserRepository implements UserRepositoryInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }
}
