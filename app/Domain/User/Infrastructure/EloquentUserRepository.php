<?php

namespace App\Domain\User\Infrastructure;

use App\Domain\User\Domain\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function findByUser(int $id): User
    {
        return User::query()->with(['roles'])->find($id);
    }

    public function getUser(int $count): LengthAwarePaginator
    {
        return User::query()->with(['roles'])->orderByDesc('created_at')->paginate($count);
    }

    public function createUser(array $data, int $roleId): bool
    {
        try {
            DB::transaction(function() use($data, $roleId) {
                $createUser = User::create($data);
                $createUser->roles()->sync($roleId);

                return $createUser->exists();
            }, 3);
        } catch (ExternalServiceException $exception) {
            return 'User Could Not Be Created!';
        }
    }

    public function updateUser(User $user, array $data, int $roleId): bool
    {
        try {
            DB::transaction(function() use($user, $data, $roleId) {
                $updateUser = $user->update($data);
                $updateUser->roles()->sync($roleId);

                return $updateUser->isDirty();
            }, 3);
        } catch (ExternalServiceException $exception) {
            return 'User Could Not Be Updated!';
        }
    }

    public function deleteUser(User $user): bool
    {
        try {
            DB::transaction(function() use($user) {
                $deleteUser = $user->roles()->detach();
                $deleteUser->delete();

                return $deleteUser->trashed();
            }, 3);
        } catch (ExternalServiceException $exception) {
            return 'User Could Not Be Deleted!';
        }
    }
}
