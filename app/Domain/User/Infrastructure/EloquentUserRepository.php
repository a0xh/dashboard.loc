<?php declare(strict_types=1);

namespace App\Domain\User\Infrastructure;

use App\Domain\User\Domain\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class EloquentUserRepository extends DecoratorUserRepository
{
    public function __construct(protected User $user) {}

    public function findByUser(int $id): User
    {
        return $this->user->query()->with(['roles'])->find($id);
    }

    public function getUser(int $count): LengthAwarePaginator
    {
        return $this->user->query()->with(['roles'])->orderByDesc('created_at')->paginate($count);
    }

    public function createUser(array $data): bool
    {
        try {
            DB::transaction(function() use($data) {
                $roleId = $data['role_id'];

                $this->user->create(data_forget($data, 'role_id'));
                $this->user->roles()->sync($roleId);
            }, 3);

            return $this->user->exists();
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }

    public function updateUser(User $user, array $data): bool
    {
        try {
            DB::transaction(function() use($user, $data) {
                $roleId = $data['role_id'];
                
                $user->update(data_forget($data, 'role_id'));
                $user->roles()->sync($roleId);
            }, 3);

            return $user->wasChanged();
        }

        catch (\ExternalServiceException $exception) {
            return false;
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
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }
}
