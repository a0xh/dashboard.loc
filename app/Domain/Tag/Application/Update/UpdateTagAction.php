<?php declare(strict_types=1);

namespace App\Domain\Tag\Application\Update;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Tag\Infrastructure\TagRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use App\Domain\Tag\Domain\{Tag, TagRequest};
use Illuminate\Support\Facades\Auth;
use Spatie\RouteAttributes\Attributes\{Put, Where};
use Illuminate\Support\Collection;
use App\Application\Traits\MediaAction;

#[Where('{tag:id}', '[0-9]+')]
final class UpdateTagAction extends Controller
{
    use MediaAction;

    public function __construct(
        private readonly TagRepositoryInterface $tagRepository,
        private readonly UpdateTagResponder $tagResponder
    ) {}

    #[Put('/admin/tag/{tag:id}/update', name: "admin.tag.update")]
    public function __invoke(Tag $tag, TagRequest $tagRequest): RedirectResponse
    {
        $tagDto = literal($tagRequest->formRequest());

        $updateMedia = $this->updateMedia($tag->media, $tagDto->getMedia());

        $data = collect([
            'title' => $tagDto->getTitle(),
            'description' => $tagDto->getDescription(),
            'keywords' => $tagDto->getKeywords(),
            'slug' => $tagDto->getSlug(),
            'type' => $tagDto->type ?? $tagDto->getType(),
            'status' => $tagDto->getStatus(),
        ]);

        $updateTag = $this->tagRepository->updateTag($tag, $data->merge([
            'media' => $updateMedia, 'user_id' => $tag->user_id
        ])->toArray());

        $redirectTo = $this->tagResponder->handle($updateTag);

        return $redirectTo;
    }
}
