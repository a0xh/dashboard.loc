<?php declare(strict_types=1);

namespace App\Domain\User\Application\Show;

use App\Infrastructure\Controllers\Controller;
use Spatie\RouteAttributes\Attributes\{Get, Where};
use App\Domain\User\Domain\User;

#[Where('{user:id}', '[0-9]+')]
final class ShowUserAction extends Controller
{
    public function __construct(
        private readonly ShowUserResponder $userResponder
    ) {}

    #[Get('/admin/user/{user:id}/show', name: "admin.user.show")]
    public function __invoke(User $user): \Illuminate\View\View
    {
        return $this->userResponder->handle(['user' => $user]);
    }
}
