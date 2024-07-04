<?php declare(strict_types=1);

namespace App\Domain\Page\Application\Edit;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Page\Infrastructure\PageRepositoryInterface;
use Spatie\RouteAttributes\Attributes\{Get, Where};
use App\Domain\Page\Domain\Page;

#[Where('{page:id}', '[0-9]+')]
final class EditPageAction extends Controller
{
    public function __construct(
        private readonly PageRepositoryInterface $pageRepository,
        private readonly EditPageResponder $pageResponder
    ) {}

    #[Get('/admin/page/{page:id}/edit', name: "admin.page.edit")]
    public function __invoke(Page $page): \Illuminate\View\View
    {
        return $this->pageResponder->handle(['page' => $page]);
    }
}
