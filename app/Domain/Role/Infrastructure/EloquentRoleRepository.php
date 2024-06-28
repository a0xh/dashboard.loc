<?php

namespace App\Domain\Role\Infrastructure;

use App\Domain\Role\Domain\Role;

class EloquentRoleRepository extends DecoratorRoleRepository
{
    public function __construct(protected Role $role) {}

    public function getRoleAll(): array
    {
        return $this->role->query()->orderBy('created_at', 'desc')->get()->all();
    }
}
