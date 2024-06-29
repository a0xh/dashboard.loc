<?php declare(strict_types=1);

namespace App\Domain\Tag\Application\Delete;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Tag\Infrastructure\TagRepositoryInterface;
use App\Application\Traits\MediaAction;
use Spatie\RouteAttributes\Attributes\{Delete, Where};
use App\Domain\Tag\Domain\Tag;
use Illuminate\Http\RedirectResponse;

#[Where('{tag:id}', '[0-9]+')]
final class DeleteTagAction extends Controller
{
    use MediaAction;

    public function __construct(
        private readonly TagRepositoryInterface $tagRepository,
        private readonly DeleteTagResponder $tagResponder
    ) {}

    #[Delete('/admin/tag/{tag:id}/delete', name: "admin.tag.delete")]
    public function __invoke(Tag $tag): RedirectResponse
    {
        if ($tag->media) {
            $this->deleteMedia($tag->media);
        }

        $deleteTag = $this->tagRepository->deleteTag($tag);
        $redirectTo = $this->tagResponder->handle($deleteTag);

        return $redirectTo;
    }
}
