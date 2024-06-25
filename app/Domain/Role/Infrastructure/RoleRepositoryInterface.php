<?php

namespace App\Domain\Role\Infrastructure;

use App\Domain\Role\Domain\Role;

interface RoleRepositoryInterface
{
    public function getRoleAll(): array;
}
