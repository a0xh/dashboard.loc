<?php declare(strict_types=1);

namespace App\Domain\User\Application\Delete;

use App\Infrastructure\Controllers\Controller;
use App\Domain\User\Infrastructure\UserRepositoryInterface;
use App\Domain\User\Domain\User;
use App\Application\Traits\MediaAction;
use Illuminate\Http\RedirectResponse;

#[Route('/admin/user/{user}/delete', name: 'admin.user.delete', method: 'DELETE')]
final class DeleteUserAction extends Controller
{
    use MediaAction;

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly DeleteUserResponder $userResponder
    ) {}

    public function __invoke(User $user): RedirectResponse
    {
        if ($user->media) {
            $this->deleteMedia($user->media);
        }

        $deleteUser = $this->userRepository->deleteUser($user);
        $redirectToUserIndex = $this->userResponder->handle($deleteUser);

        return $redirectToUserIndex;
    }
}
