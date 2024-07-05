<?php declare(strict_types=1);

namespace App\Domain\Page\Application\Create;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Page\Infrastructure\PageRepositoryInterface;
use Spatie\RouteAttributes\Attributes\Get;

final class CreatePageAction extends Controller
{
    public function __construct(
        private readonly PageRepositoryInterface $pageRepository,
        private readonly CreatePageResponder $pageResponder
    ) {}

    #[Get('/admin/page/create', name: "admin.page.create")]
    public function __invoke(): \Illuminate\View\View
    {
        return $this->pageResponder->handle();
    }
}
