<?php declare(strict_types=1);

namespace App\Domain\User\Application\Store;

use App\Infrastructure\Controllers\Controller;
use App\Domain\User\Infrastructure\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use App\Domain\User\Domain\{User, UserRequest};
use App\Application\Traits\MediaAction;
use Illuminate\Support\Collection;

#[Route('/admin/user/store', name: 'admin.user.store', method: 'POST')]
final class StoreUserAction extends Controller
{
    use MediaAction;

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly StoreUserResponder $userResponder
    ) {}

    public function __invoke(UserRequest $userRequest): RedirectResponse
    {
        $userDto = literal($userRequest->formRequest());

        $createMedia = $this->createMedia($userDto->getMedia());

        $data = collect([
            'first_name' => $userDto->getFirstName(),
            'last_name' => $userDto->getLastName(),
            'email' => $userDto->getEmail(),
            'password' => $userDto->getHashPassword(),
            'status' => $userDto->getStatus()
        ]);

        $createUser = $this->userRepository->createUser($data->merge([
            'media' => $createMedia, 'data' => $userDto->getData(),
        ])->toArray(), $userDto->getRoleId());

        $redirectToUserIndex = $this->userResponder->handle($createUser);

        return $redirectToUserIndex;
    }
}
