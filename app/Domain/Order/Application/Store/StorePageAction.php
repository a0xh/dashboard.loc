<?php declare(strict_types=1);

namespace App\Domain\Page\Application\Store;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Page\Infrastructure\PageRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use App\Domain\Page\Domain\PageRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\RouteAttributes\Attributes\Post;
use Illuminate\Support\Collection;
use App\Application\Traits\MediaAction;

final class StorePageAction extends Controller
{
    use MediaAction;

    public function __construct(
        private readonly PageRepositoryInterface $pageRepository,
        private readonly StorePageResponder $pageResponder
    ) {}

    #[Post('/admin/page/store', name: "admin.page.store")]
    public function __invoke(PageRequest $pageRequest): RedirectResponse
    {
        $pageDto = literal($pageRequest->formRequest());

        $createMedia = $this->createMedia($pageDto->getMedia());

        $data = collect([
            'title' => $pageDto->getTitle(),
            'description' => $pageDto->getDescription(),
            'slug' => $pageDto->getSlug(),
            'keywords' => $pageDto->getKeywords(),
            'status' => $pageDto->getStatus(),
            'content' => $pageDto->getContent(),
            'data' => $pageDto->getData(),
        ]);

        $createPage = $this->pageRepository->createPage($data->merge([
            'user_id' => Auth::user()->id, 'media' => $createMedia
        ])->toArray());

        $redirectTo = $this->pageResponder->handle($createPage);

        return $redirectTo;
    }
}
