<?php declare(strict_types=1);

namespace App\Domain\Tag\Application\Edit;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Tag\Infrastructure\TagRepositoryInterface;
use Spatie\RouteAttributes\Attributes\{Get, Where};
use App\Domain\Tag\Domain\Tag;

#[Where('{tag:id}', '[0-9]+')]
final class EditTagAction extends Controller
{
    public function __construct(
        private readonly TagRepositoryInterface $tagRepository,
        private readonly EditTagResponder $tagResponder
    ) {}

    #[Get('/admin/tag/{tag:id}/edit', name: "admin.tag.edit")]
    public function __invoke(Tag $tag): \Illuminate\View\View
    {
        return $this->tagResponder->handle([
            'tag' => $tag
        ]);
    }
}
