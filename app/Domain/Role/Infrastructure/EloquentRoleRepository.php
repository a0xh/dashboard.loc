<?php

namespace App\Domain\Role\Infrastructure;

use App\Domain\Role\Domain\Role;

class EloquentRoleRepository implements RoleRepositoryInterface
{
    public function getRoleAll(): array
    {
        return Role::query()->orderBy('created_at', 'desc')->get()->all();
    }
}
