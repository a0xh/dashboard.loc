<?php declare(strict_types=1);

namespace App\Domain\User\Application\Delete;

use App\Infrastructure\Controllers\Controller;
use App\Domain\User\Infrastructure\UserRepositoryInterface;
use App\Application\Traits\MediaAction;
use Spatie\RouteAttributes\Attributes\{Delete, Where};
use App\Domain\User\Domain\User;
use Illuminate\Http\RedirectResponse;

#[Where('{user:id}', '[0-9]+')]
final class DeleteUserAction extends Controller
{
    use MediaAction;

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly DeleteUserResponder $userResponder
    ) {}

    #[Delete('/admin/user/{user:id}/delete', name: "admin.user.delete")]
    public function __invoke(User $user): RedirectResponse
    {
        if ($user->media) {
            $this->deleteMedia($user->media);
        }

        $deleteUser = $this->userRepository->deleteUser($user);
        $redirectTo = $this->userResponder->handle($deleteUser);

        return $redirectTo;
    }
}
