<?php declare(strict_types=1);

namespace App\Domain\Tag\Application\Index;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Tag\Infrastructure\TagRepositoryInterface;
use App\Domain\Tag\Domain\Tag;
use Spatie\RouteAttributes\Attributes\Get;

final class IndexTagAction extends Controller
{
    public function __construct(
        private readonly TagRepositoryInterface $tagRepository,
        private readonly IndexTagResponder $tagResponder
    ) {}

    #[Get('/admin/tag', name: 'admin.tag.index')]
    public function __invoke(): \Illuminate\View\View
    {
        return $this->tagResponder->handle([
            'tagsTypeProduct' => $this->tagRepository->getTagByProduct(11),
            'tagsTypePost' => $this->tagRepository->getTagByPost(11)
        ]);
    }
}
