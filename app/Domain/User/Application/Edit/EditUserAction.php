<?php declare(strict_types=1);

namespace App\Domain\User\Application\Edit;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Role\Infrastructure\RoleRepositoryInterface;
use Spatie\RouteAttributes\Attributes\{Get, Where};
use App\Domain\User\Domain\User;

#[Where('{user:id}', '[0-9]+')]
final class EditUserAction extends Controller
{
    public function __construct(
        private readonly RoleRepositoryInterface $roleRepository,
        private readonly EditUserResponder $userResponder
    ) {}

    #[Get('/admin/user/{user:id}/edit', name: "admin.user.edit")]
    public function __invoke(User $user): \Illuminate\View\View
    {
        return $this->userResponder->handle([
            'roles' => $this->roleRepository->getRoleAll(),
            'user' => $user
        ]);
    }
}
