<?php declare(strict_types=1);

namespace App\Domain\Role\Infrastructure;

use App\Domain\Role\Domain\Role;

abstract class DecoratorRoleRepository implements RoleRepositoryInterface
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository) {
        $this->roleRepository = $roleRepository;
    }
}
