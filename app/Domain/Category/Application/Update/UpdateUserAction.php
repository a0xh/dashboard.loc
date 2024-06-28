<?php declare(strict_types=1);

namespace App\Domain\Category\Application\Update;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Category\Infrastructure\CategoryRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use App\Domain\Category\Domain\{Category, CategoryRequest};
use Illuminate\Support\Facades\Auth;
use Spatie\RouteAttributes\Attributes\{Put, Defaults};
use Illuminate\Support\Collection;
use App\Application\Traits\MediaAction;

#[Defaults('type', ['product', 'post'])]
final class UpdateCategoryAction extends Controller
{
    use MediaAction;

    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly UpdateCategoryResponder $categoryResponder
    ) {}

    #[Put('/admin/category/{category:id}/update/{type}', name: "admin.category.update")]
    public function __invoke(Category $category, CategoryRequest $categoryRequest): RedirectResponse
    {
        $categoryDto = literal($categoryRequest->formRequest());

        $updateMedia = $this->updateMedia($category->media, $categoryDto->getMedia());

        $data = collect([
            'title' => $categoryDto->getTitle(),
            'slug' => $categoryDto->getSlug(),
            'description' => $categoryDto->getDescription(),
            'keywords' => $categoryDto->getKeywords(),
            'category_id' => $categoryDto->getCategoryId(),
            'status' => $categoryDto->getStatus(),
            'data' => $categoryDto->getData()
        ]);

        $updateCategory = $this->categoryRepository->updateCategory($category, $data->merge([
                'type' => request()->query('type', null),
                'media' => $createMedia,
                'user_id' => $category->user_id
        ])->toArray());

        $redirectTo = $this->categoryResponder->handle($updateCategory);

        return $redirectTo;
    }
}
