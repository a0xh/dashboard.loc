<?php declare(strict_types=1);

namespace App\Domain\User\Application\Create;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Role\Infrastructure\RoleRepositoryInterface;

#[Route('/admin/user/create', name: 'admin.user.create', method: 'GET', middleware: 'admin')]
final class CreateUserAction extends Controller
{
    public function __construct(
        private readonly RoleRepositoryInterface $roleRepository,
        private readonly CreateUserResponder $userResponder
    ) {}

    public function __invoke(): \Illuminate\View\View
    {
        return $this->userResponder->handle([
            'roles' => $this->roleRepository->getRoleAll()
        ]);
    }
}
