<?php declare(strict_types=1);

namespace App\Domain\Post\Application\Delete;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Post\Infrastructure\PostRepositoryInterface;
use App\Application\Traits\MediaAction;
use Spatie\RouteAttributes\Attributes\{Delete, Where};
use App\Domain\Post\Domain\Post;
use Illuminate\Http\RedirectResponse;

#[Where('{post:id}', '[0-9]+')]
final class DeletePostAction extends Controller
{
    use MediaAction;

    public function __construct(
        private readonly PostRepositoryInterface $postRepository,
        private readonly DeletePostResponder $postResponder
    ) {}

    #[Delete('/admin/post/{post:id}/delete', name: "admin.post.delete")]
    public function __invoke(Post $post): RedirectResponse
    {
        if ($post->media) {
            $this->deleteMedia($post->media);
        }

        $deletePost = $this->postRepository->deletePost($post);
        $redirectTo = $this->postResponder->handle($deletePost);

        return $redirectTo;
    }
}
