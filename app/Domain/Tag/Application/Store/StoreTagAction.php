<?php declare(strict_types=1);

namespace App\Domain\Tag\Application\Store;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Tag\Infrastructure\TagRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use App\Domain\Tag\Domain\{Tag, TagRequest};
use Illuminate\Support\Facades\Auth;
use Spatie\RouteAttributes\Attributes\Post;
use Illuminate\Support\Collection;
use App\Application\Traits\MediaAction;

final class StoreTagAction extends Controller
{
    use MediaAction;

    public function __construct(
        private readonly TagRepositoryInterface $tagRepository,
        private readonly StoreTagResponder $tagResponder
    ) {}

    #[Post('/admin/tag/store', name: "admin.tag.store")]
    public function __invoke(TagRequest $tagRequest): RedirectResponse
    {
        $tagDto = literal($tagRequest->formRequest());

        $createMedia = $this->createMedia($tagDto->getMedia());

        $data = collect([
            'title' => $tagDto->getTitle(),
            'description' => $tagDto->getDescription(),
            'slug' => $tagDto->getSlug(),
            'keywords' => $tagDto->getKeywords(),
            'status' => $tagDto->getStatus(),
            'type' => $tagDto->getType()
        ]);

        $createTag = $this->tagRepository->createTag($data->merge([
            'user_id' => Auth::user()->id, 'media' => $createMedia
        ])->toArray());

        $redirectTo = $this->tagResponder->handle($createTag);

        return $redirectTo;
    }
}
