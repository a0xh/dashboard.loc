<?php declare(strict_types=1);

namespace App\Domain\Tag\Application\Create;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Tag\Infrastructure\TagRepositoryInterface;
use Spatie\RouteAttributes\Attributes\{Get, Defaults};
use App\Domain\Tag\Domain\Tag;

#[Defaults('type', 'product')]
#[Defaults('type', 'post')]
final class CreateTagAction extends Controller
{
    public function __construct(
        private readonly TagRepositoryInterface $tagRepository,
        private readonly CreateTagResponder $tagResponder
    ) {}

    #[Get('/admin/tag/create/{type}', name: "admin.tag.create")]
    public function __invoke(): \Illuminate\View\View
    {
        $type = str_replace('admin/tag/create/', '', request()->path());

        return $this->tagResponder->handle([
            'type' => $type
        ]);
    }
}
