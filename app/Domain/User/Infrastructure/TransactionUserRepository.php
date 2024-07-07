<?php declare(strict_types=1);

namespace App\Domain\User\Infrastructure;

use App\Domain\User\Domain\{UserDto, User};
use Illuminate\Support\Facades\DB;

final class TransactionUserRepository implements UserRepositoryInterface
{
    public function __construct(
        private readonly EloquentUserRepository $eloquentUserRepository
    ) {}

    public function createUser(UserDto $userDto): bool
    {
        try {
            DB::transaction(function() use($userDto): void {
                $this->eloquentUserRepository->createUser($userDto);
            }, 3);

            return true;
        }

        catch (\ExternalServiceException $exception) {
            return $exception;
        }
    }

    public function updateUser(User $user, UserDto $userDto): bool
    {
        try {
            DB::transaction(function() use($user, $userDto): void {
                $this->eloquentUserRepository->updateUser($user, $userDto);
            }, 3);

            return true;
        }

        catch (\ExternalServiceException $exception) {
            return $exception;
        }
    }

    public function deleteUser(User $user): bool
    {
        try {
            DB::transaction(function() use($user): void {
                $this->eloquentUserRepository->deleteUser($user);
            }, 3);

            return true;
        }

        catch (\ExternalServiceException $exception) {
            return $exception;
        }
    }
}
