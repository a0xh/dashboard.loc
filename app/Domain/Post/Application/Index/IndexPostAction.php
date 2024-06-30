<?php declare(strict_types=1);

namespace App\Domain\Post\Application\Index;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Post\Infrastructure\PostRepositoryInterface;
use App\Domain\Post\Domain\Post;
use Spatie\RouteAttributes\Attributes\Get;

final class IndexPostAction extends Controller
{
    public function __construct(
        private readonly PostRepositoryInterface $postRepository,
        private readonly IndexPostResponder $postResponder
    ) {}

    #[Get('/admin/post', name: 'admin.post.index')]
    public function __invoke(): \Illuminate\View\View
    {
        return $this->postResponder->handle([
            'posts' => $this->postRepository->getPost(11),
        ]);
    }
}
