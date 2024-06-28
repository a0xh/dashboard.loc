<?php declare(strict_types=1);

namespace App\Domain\Category\Application\Store;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Category\Infrastructure\CategoryRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use App\Domain\Category\Domain\{Category, CategoryRequest};
use Illuminate\Support\Facades\Auth;
use Spatie\RouteAttributes\Attributes\Post;
use Illuminate\Support\Collection;
use App\Application\Traits\MediaAction;

#[Defaults('type', ['product', 'post'])]
final class StoreCategoryAction extends Controller
{
    use MediaAction;

    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly StoreCategoryResponder $categoryResponder
    ) {}

    #[Post('/admin/category/store/{type}', name: "admin.category.store")]
    public function __invoke(CategoryRequest $categoryRequest): RedirectResponse
    {
        $categoryDto = literal($categoryRequest->formRequest());

        $createMedia = $this->createMedia($categoryDto->getMedia());

        $data = collect([
            'title' => $categoryDto->getTitle(),
            'slug' => $categoryDto->getSlug(),
            'description' => $categoryDto->getDescription(),
            'keywords' => $categoryDto->getKeywords(),
            'category_id' => $categoryDto->getCategoryId(),
            'status' => $categoryDto->getStatus(),
            'data' => $categoryDto->getData()
        ]);

        $createCategory = $this->categoryRepository->createCategory(
            $data->merge([
                'type' => request()->query('type', null),
                'media' => $createMedia,
                'user_id' => Auth::user()->id
            ])->toArray()
        );

        $redirectTo = $this->categoryResponder->handle($createCategory);

        return $redirectTo;
    }
}
