<?php declare(strict_types=1);

namespace App\Domain\Category\Application\Delete;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Category\Infrastructure\CategoryRepositoryInterface;
use App\Application\Traits\MediaAction;
use Spatie\RouteAttributes\Attributes\{Delete, Where};
use App\Domain\Category\Domain\Category;
use Illuminate\Http\RedirectResponse;

#[Where('{category:id}', '[0-9]+')]
final class DeleteCategoryAction extends Controller
{
    use MediaAction;

    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly DeleteCategoryResponder $categoryResponder
    ) {}

    #[Delete('/admin/category/{category:id}/delete', name: "admin.category.delete")]
    public function __invoke(Category $category): RedirectResponse
    {
        if ($category->media) {
            $this->deleteMedia($category->media);
        }

        $deleteCategory = $this->categoryRepository->deleteCategory($category);
        $redirectTo = $this->categoryResponder->handle($deleteCategory);

        return $redirectTo;
    }
}
