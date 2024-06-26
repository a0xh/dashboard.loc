<?php declare(strict_types=1);

namespace App\Domain\Post\Application\Edit;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Post\Infrastructure\PostRepositoryInterface;
use App\Domain\Category\Infrastructure\CategoryRepositoryInterface;
use App\Domain\Tag\Infrastructure\TagRepositoryInterface;
use Spatie\RouteAttributes\Attributes\{Get, Where};
use App\Domain\Post\Domain\Post;

#[Where('{post:id}', '[0-9]+')]
final class EditPostAction extends Controller
{
    public function __construct(
        private readonly PostRepositoryInterface $postRepository,
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly TagRepositoryInterface $tagRepository,
        private readonly EditPostResponder $postResponder
    ) {}

    #[Get('/admin/post/{post:id}/edit', name: "admin.post.edit")]
    public function __invoke(Post $post): \Illuminate\View\View
    {
        return $this->postResponder->handle([
            'categories' => $this->categoryRepository->getCategoryAll('post'),
            'tags' => $this->tagRepository->getTagAll('post'),
            'post' => $post
        ]);
    }
}
