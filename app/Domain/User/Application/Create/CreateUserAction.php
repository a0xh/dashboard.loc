<?php declare(strict_types=1);

namespace App\Domain\User\Application\Create;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Role\Infrastructure\RoleRepositoryInterface;
use Spatie\RouteAttributes\Attributes\Get;

final class CreateUserAction extends Controller
{
    public function __construct(
        private readonly RoleRepositoryInterface $roleRepository,
        private readonly CreateUserResponder $userResponder
    ) {}

    #[Get('/admin/user/create', name: "admin.user.create")]
    public function __invoke(): \Illuminate\View\View
    {
        return $this->userResponder->handle([
            'roles' => $this->roleRepository->getRoleAll()
        ]);
    }
}
