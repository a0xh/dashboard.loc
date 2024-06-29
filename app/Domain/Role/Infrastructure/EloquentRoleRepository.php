<?php

namespace App\Domain\Role\Infrastructure;

use App\Domain\Role\Domain\Role;

class EloquentRoleRepository extends DecoratorRoleRepository
{
    public function __construct(protected Role $role) {}

    public function getRoleAll(): array
    {
        $getRoleAll = $this->role->query()->orderBy('created_at', 'desc');
        
        return $getRoleAll->get()->map(fn ($role) => [
            'id' => $role->id,
            'name' => $role->name,
        ])->all();
    }
}
