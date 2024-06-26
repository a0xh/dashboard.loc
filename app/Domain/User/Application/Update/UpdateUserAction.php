<?php declare(strict_types=1);

namespace App\Domain\User\Application\Update;

use App\Infrastructure\Controllers\Controller;
use App\Domain\User\Infrastructure\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use App\Domain\User\Domain\{User, UserRequest};
use App\Application\Traits\MediaAction;
use Spatie\RouteAttributes\Attributes\{Put, ScopeBindings};
use Illuminate\Support\Collection;

final class UpdateUserAction extends Controller
{
    use MediaAction;

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UpdateUserResponder $userResponder
    ) {}

    #[Put('/admin/user/{user:id}/update', name: "admin.user.update")]
    #[ScopeBindings]
    public function __invoke(User $user, UserRequest $userRequest): RedirectResponse
    {
        $userDto = literal($userRequest->formRequest());

        $updateMedia = $this->updateMedia($user->media, $userDto->getMedia());

        $data = collect([
            'first_name' => $userDto->getFirstName(),
            'last_name' => $userDto->getLastName(),
            'email' => $userDto->getEmail(),
            'password' => $userDto->getHashPassword(),
            'status' => $userDto->getStatus()
        ]);

        $updateUser = $this->userRepository->updateUser($user, $data->merge([
            'media' => $updateMedia, 'data' => $userDto->getData(),
        ])->toArray(), $userDto->getRoleId());

        $redirectTo = $this->userResponder->handle($updateUser);

        return $redirectTo;
    }
}
