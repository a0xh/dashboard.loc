<?php declare(strict_types=1);

namespace App\Domain\Post\Application\Store;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Post\Infrastructure\PostRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use App\Domain\Post\Domain\PostRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\RouteAttributes\Attributes\Post;
use Illuminate\Support\Collection;
use App\Application\Traits\MediaAction;

final class StorePostAction extends Controller
{
    use MediaAction;

    public function __construct(
        private readonly PostRepositoryInterface $postRepository,
        private readonly StorePostResponder $postResponder
    ) {}

    #[Post('/admin/post/store', name: "admin.post.store")]
    public function __invoke(PostRequest $postRequest): RedirectResponse
    {
        $postDto = literal($postRequest->formRequest());

        $createMedia = $this->createMedia($postDto->getMedia());

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

        $createPost = $this->postRepository->createPost($data->merge([
            'user_id' => Auth::user()->id, 'media' => $createMedia
        ])->toArray());

        $redirectTo = $this->postResponder->handle($createPost);

        return $redirectTo;
    }
}
