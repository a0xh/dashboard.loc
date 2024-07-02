<?php declare(strict_types=1);

namespace App\Domain\Post\Application\Update;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Post\Infrastructure\PostRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use App\Domain\Post\Domain\{Post, PostRequest};
use Illuminate\Support\Facades\Auth;
use Spatie\RouteAttributes\Attributes\{Put, Where};
use Illuminate\Support\Collection;
use App\Application\Traits\MediaAction;

#[Where('{post:id}', '[0-9]+')]
final class UpdatePostAction extends Controller
{
    use MediaAction;

    public function __construct(
        private readonly PostRepositoryInterface $postRepository,
        private readonly UpdatePostResponder $postResponder
    ) {}

    #[Put('/admin/post/{post:id}/update', name: "admin.post.update")]
    public function __invoke(Post $post, PostRequest $postRequest): RedirectResponse
    {
        $postDto = literal($postRequest->formRequest());

        $updateMedia = $this->updateMedia($post->media, $postDto->getMedia());

        $data = collect([
            'title' => $postDto->getTitle(),
            'description' => $postDto->getDescription(),
            'slug' => $postDto->getSlug(),
            'keywords' => $postDto->getKeywords(),
            'category_id' => $postDto->getCategoryId(),
            'status' => $postDto->getStatus(),
            'content' => $postDto->getContent(),
            'data' => $postDto->getData(),
            'tag_id' => $postDto->getTagId()
        ]);

        $updatePost = $this->postRepository->updatePost($post, $data->merge([
            'media' => $updateMedia, 'user_id' => $post->user_id
        ])->toArray());

        $redirectTo = $this->postResponder->handle($updatePost);

        return $redirectTo;
    }
}
