<?php declare(strict_types=1);

namespace App\Domain\User\Application\Edit;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Role\Infrastructure\RoleRepositoryInterface;
use App\Domain\User\Domain\User;
use App\Domain\Role\Domain\Role;

#[Route('/admin/user/{user}/edit', name: 'admin.user.edit', method: 'GET')]
final class EditUserAction extends Controller
{
    public function __construct(
        private readonly RoleRepositoryInterface $roleRepository,
        private readonly EditUserResponder $userResponder
    ) {}

    public function __invoke(User $user): \Illuminate\View\View
    {
        $getRoleAll = $this->roleRepository->getRoleAll();
        $respondViewUserEdit = $this->userResponder->handle($user, $getRoleAll);

        return $respondViewUserEdit;
    }
}
