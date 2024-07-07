<?php declare(strict_types=1);

namespace App\Domain\User\Application\Delete;

use App\Infrastructure\Controllers\Controller;
use App\Domain\User\Infrastructure\UserRepositoryInterface;
use App\Domain\User\Domain\{User, UserRequest};
use Spatie\RouteAttributes\Attributes\{Delete, Where};
use Illuminate\Http\RedirectResponse;

#[Where('{user:id}', '[0-9]+')]
final class DeleteUserAction extends Controller
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly DeleteUserResponder $userResponder
    ) {}

    #[Delete('/admin/user/{user:id}/delete', name: "admin.user.delete")]
    public function __invoke(User $user): RedirectResponse
    {
        $request = (new UserRequest(request()->all()));
        
        if ($request->string('id')->trim()->value == $user->id)
        {
            $deleteUser = $this->userRepository->deleteUser($user);
            return $this->userResponder->handle($deleteUser);
        }

        return $this->userResponder->handle(false);
    }
}
