<?php declare(strict_types=1);

namespace App\Domain\Role\Infrastructure;

use App\Domain\Role\Domain\Role;
use Illuminate\Cache\CacheManager;

class CachedRoleRepository implements RoleRepositoryInterface
{
    protected const TTL = 1440;

    public function __construct(
        protected EloquentRoleRepository $roleRepository,
        protected CacheManager $cache
    ) {}

    public function getRoleAll(): array
    {
        $getRoleAll = $this->cache->remember('roles', self::TTL, function() {
            return $this->roleRepository->getRoleAll();
        });

        return $getRoleAll;
    }
}
