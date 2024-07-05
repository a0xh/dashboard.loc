<?php declare(strict_types=1);

namespace App\Domain\Page\Application\Index;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Page\Infrastructure\PageRepositoryInterface;
use App\Domain\Page\Domain\Page;
use Spatie\RouteAttributes\Attributes\Get;

final class IndexPageAction extends Controller
{
    public function __construct(
        private readonly PageRepositoryInterface $pageRepository,
        private readonly IndexPageResponder $pageResponder
    ) {}

    #[Get('/admin/page', name: 'admin.page.index')]
    public function __invoke(): \Illuminate\View\View
    {
        return $this->pageResponder->handle([
            'pages' => $this->pageRepository->getPage(11),
        ]);
    }
}
