<?php declare(strict_types=1);

namespace App\Domain\User\Application\Store;

use App\Infrastructure\Controllers\Controller;
use App\Domain\User\Infrastructure\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Spatie\RouteAttributes\Attributes\Post;
use App\Domain\User\Domain\UserRequest;

final class StoreUserAction extends Controller
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly StoreUserResponder $userResponder
    ) {}

    #[Post('/admin/user/store', name: "admin.user.store")]
    public function __invoke(UserRequest $userRequest): RedirectResponse
    {
        $createUser = $this->userRepository->createUser(
            $userRequest->toDto()
        );

        return $this->userResponder->handle($createUser);
    }
}
