<?php declare(strict_types=1);

namespace App\Domain\Post\Application\Create;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Post\Infrastructure\PostRepositoryInterface;
use App\Domain\Category\Infrastructure\CategoryRepositoryInterface;
use App\Domain\Tag\Infrastructure\TagRepositoryInterface;
use Spatie\RouteAttributes\Attributes\Get;

final class CreatePostAction extends Controller
{
    public function __construct(
        private readonly PostRepositoryInterface $postRepository,
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly TagRepositoryInterface $tagRepository,
        private readonly CreatePostResponder $postResponder
    ) {}

    #[Get('/admin/post/create', name: "admin.post.create")]
    public function __invoke(): \Illuminate\View\View
    {
        $categories = $this->categoryRepository->getCategoryAll('post');
        $tags = $this->tagRepository->getTagAll('post');
        
        return $this->postResponder->handle([
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }
}
