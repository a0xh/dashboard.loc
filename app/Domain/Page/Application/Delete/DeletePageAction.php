<?php declare(strict_types=1);

namespace App\Domain\Page\Application\Delete;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Page\Infrastructure\PageRepositoryInterface;
use App\Application\Traits\MediaAction;
use Spatie\RouteAttributes\Attributes\{Delete, Where};
use App\Domain\Page\Domain\Page;
use Illuminate\Http\RedirectResponse;

#[Where('{page:id}', '[0-9]+')]
final class DeletePageAction extends Controller
{
    use MediaAction;

    public function __construct(
        private readonly PageRepositoryInterface $pageRepository,
        private readonly DeletePageResponder $pageResponder
    ) {}

    #[Delete('/admin/page/{page:id}/delete', name: "admin.page.delete")]
    public function __invoke(Page $page): RedirectResponse
    {
        if ($page->media) {
            $this->deleteMedia($page->media);
        }

        $deletePage = $this->pageRepository->deletePage($page);
        $redirectTo = $this->pageResponder->handle($deletePage);

        return $redirectTo;
    }
}
