<?php declare(strict_types=1);

namespace App\Domain\Post\Application\Create;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Post\Infrastructure\PostRepositoryInterface;
use Spatie\RouteAttributes\Attributes\Get;
use App\Domain\Post\Domain\Post;

final class CreatePostAction extends Controller
{
    public function __construct(
        private readonly PostRepositoryInterface $postRepository,
        private readonly CreatePostResponder $postResponder
    ) {}

    #[Get('/admin/post/create', name: "admin.post.create")]
    public function __invoke(): \Illuminate\View\View
    {

        return $this->postResponder->handle();
    }
}
