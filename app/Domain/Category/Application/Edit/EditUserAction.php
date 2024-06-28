<?php declare(strict_types=1);

namespace App\Domain\Category\Application\Edit;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Role\Infrastructure\CategoryRepositoryInterface;
use Spatie\RouteAttributes\Attributes\{Get, Where};
use App\Domain\Category\Domain\Category;

#[Where('{category:id}', '[0-9]+')]
final class EditCategoryAction extends Controller
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly EditCategoryResponder $categoryResponder
    ) {}

    #[Get('/admin/category/{category:id}/edit', name: "admin.category.edit")]
    public function __invoke(Category $category): \Illuminate\View\View
    {
        return $this->categoryResponder->handle([
            'categoriesTypeProduct' => $this->category->getCategoryAll('product'),
            'categoriesTypePost' => $this->category->getCategoryAll('post'),
            'category' => $category
        ]);
    }
}
