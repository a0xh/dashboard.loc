<?php declare(strict_types=1);

namespace App\Domain\Page\Application\Update;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Page\Infrastructure\PageRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use App\Domain\Page\Domain\{Page, PageRequest};
use Illuminate\Support\Facades\Auth;
use Spatie\RouteAttributes\Attributes\{Put, Where};
use Illuminate\Support\Collection;
use App\Application\Traits\MediaAction;

#[Where('{page:id}', '[0-9]+')]
final class UpdatePageAction extends Controller
{
    use MediaAction;

    public function __construct(
        private readonly PageRepositoryInterface $pageRepository,
        private readonly UpdatePageResponder $pageResponder
    ) {}

    #[Put('/admin/page/{page:id}/update', name: "admin.page.update")]
    public function __invoke(Page $page, PageRequest $pageRequest): RedirectResponse
    {
        $pageDto = literal($pageRequest->formRequest());

        $updateMedia = $this->updateMedia($page->media, $pageDto->getMedia());

        $data = collect([
            'title' => $pageDto->getTitle(),
            'description' => $pageDto->getDescription(),
            'slug' => $pageDto->getSlug(),
            'keywords' => $pageDto->getKeywords(),
            'status' => $pageDto->getStatus(),
            'content' => $pageDto->getContent(),
            'data' => $pageDto->getData(),
        ]);

        $updatePage = $this->pageRepository->updatePage($page, $data->merge([
            'media' => $updateMedia, 'user_id' => $page->user_id
        ])->toArray());

        $redirectTo = $this->pageResponder->handle($updatePage);

        return $redirectTo;
    }
}
