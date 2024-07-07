<?php declare(strict_types=1);

namespace App\Domain\User\Infrastructure;

use App\Domain\User\Domain\{UserDto, User};
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Application\Traits\MediaAction;

final class EloquentUserRepository extends DecoratorUserRepository
{
    use MediaAction;

    public function __construct(private readonly User $user) {}

    public function findByUser(string $id): Collection
    {
        $findByUser = $this->user->query()->with('roles')->find($id);
        
        return collect([
            'id' => $findByUser->id ?? null,
            'ip_address' => $findByUser->data->ip_address,
            'avatar' => $findByUser->media,
            'first_name' => $findByUser->first_name ?? null,
            'status' => $findByUser->status->value,
            'last_name' => $findByUser->last_name ?? null,
            'email' => $findByUser->email ?? null,
            'roles' => $findByUser->roles,
        ]);
    }

    public function getUser(): LengthAwarePaginator
    {
        $query = $this->user->query()->with('roles');
        $getUser = $query->orderByDesc('created_at');

        return $getUser->paginate(11)->through(fn ($user) => [
            'id' => $user->id ?? null,
            'ip_address' => $user->data->ip_address,
            'avatar' => $user->media,
            'first_name' => $user->first_name ?? null,
            'status' => $user->status->value,
            'last_name' => $user->last_name ?? null,
            'email' => $user->email ?? null,
            'roles' => $user->roles,
        ]);
    }

    public function createUser(UserDto $userDto): bool
    {
        $createMedia = $this->createMedia($userDto->getMedia());

        $dataUser = collect([
            'first_name' => $userDto->getFirstName(),
            'last_name' => $userDto->getLastName(),
            'email' => $userDto->getEmail(),
            'status' => $userDto->getStatus(),
            'password' => $userDto->getHashPassword(),
            'data' => $userDto->getData()
        ])->merge(['media' => $createMedia]);

        $createUser = $this->user->create($dataUser->toArray());
        $createUser->roles()->sync($userDto->getRoleId());

        return $createUser->exists();
    }

    public function updateUser(User $user, UserDto $userDto): bool
    {
        $user->email = $userDto->getEmail();
        $user->last_name = $userDto->getLastName();
        $user->status = $userDto->getStatus();
        $user->password = $userDto->getHashPassword();
        $user->data = $userDto->getData();
        $user->first_name = $userDto->getFirstName();
        $user->media = $this->updateMedia(
            $user->media, $userDto->getMedia()
        );

        $user->save();

        $user->roles()->sync($userDto->getRoleId());

        return $user->wasChanged();
    }

    public function deleteUser(User $user): bool
    {
        if ($user->media) {
            $this->deleteMedia($user->media);
        }

        $user->roles()->detach();
        $user->delete();

        if ($user->deleteOrFail() !== true) {
            return true;
        } else {
            return false;
        }
    }
}
