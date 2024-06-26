<?php declare(strict_types=1);

namespace App\Domain\User\Application\Show;

use App\Infrastructure\Controllers\Controller;
use App\Domain\User\Domain\User;

#[Route('/admin/user/{user}/show', name: 'admin.user.show', method: 'GET', middleware: 'admin')]
final class ShowUserAction extends Controller
{
    public function __construct(
        private readonly ShowUserResponder $userResponder
    ) {}

    public function __invoke(User $user): \Illuminate\View\View
    {
        return $this->userResponder->handle(['user' => $user]);
    }
}
