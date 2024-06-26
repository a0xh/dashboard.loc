<?php declare(strict_types=1);

namespace App\Domain\User\Application\Index;

use App\Infrastructure\Controllers\Controller;
use App\Domain\User\Infrastructure\UserRepositoryInterface;
use App\Domain\User\Domain\User;

#[Route('/admin/user', name: 'admin.user.index', method: 'GET', middleware: 'admin')]
final class IndexUserAction extends Controller
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly IndexUserResponder $userResponder
    ) {}
    
    public function __invoke(): \Illuminate\View\View
    {
        return $this->userResponder->handle([
            'users' => $this->userRepository->getUser(11)
        ]);
    }
}
