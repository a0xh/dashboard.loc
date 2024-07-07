<?php declare(strict_types=1);

namespace App\Domain\User\Application\Update;

use App\Infrastructure\Controllers\Controller;
use App\Domain\User\Infrastructure\UserRepositoryInterface;
use App\Domain\User\Domain\{User, UserRequest};
use Spatie\RouteAttributes\Attributes\{Put, Where};
use Illuminate\Http\RedirectResponse;

#[Where('{user:id}', '[0-9]+')]
final class UpdateUserAction extends Controller
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UpdateUserResponder $userResponder
    ) {}

    #[Put('/admin/user/{user:id}/update', name: "admin.user.update")]
    public function __invoke(User $user, UserRequest $request): RedirectResponse
    {
        return $this->userResponder->handle($this->userRepository->updateUser(
            $user, $request->toDto()
        ));
    }
}
