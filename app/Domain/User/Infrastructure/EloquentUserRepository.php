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
                $user = User::create($data);
                $user->roles()->sync($roleId);
            }, 3);
            return $createUser->exists();
        } catch (ExternalServiceException $exception) {
            return 'User Could Not Be Created!';
        }
    }

    public function updateUser(User $user, array $data, int $roleId): bool
    {
        try {
            DB::transaction(function() use($user, $data, $roleId) {
                $user->update($data);
                $user->roles()->sync($roleId);
            }, 3);
            return $user->wasChanged();
        } catch (ExternalServiceException $exception) {
            return 'User Could Not Be Updated!';
        }
    }

    public function deleteUser(User $user): bool
    {
        try {
            DB::transaction(function() use($user) {
                $user->roles()->detach();
                $user->delete();
            }, 3);
            return $user->trashed();
        } catch (ExternalServiceException $exception) {
            return 'User Could Not Be Deleted!';
        }
    }
}
