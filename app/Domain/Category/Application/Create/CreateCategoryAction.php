<?php declare(strict_types=1);

namespace App\Domain\Category\Application\Create;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Category\Infrastructure\CategoryRepositoryInterface;
use Spatie\RouteAttributes\Attributes\{Get, Defaults};
use App\Domain\Category\Domain\Category;

#[Defaults('type', ['product', 'post'])]
final class CreateCategoryAction extends Controller
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly CreateCategoryResponder $categoryResponder
    ) {}

    #[Get('/admin/category/create/{type}', name: "admin.category.create")]
    public function __invoke(): \Illuminate\View\View
    {
        return $this->categoryResponder->handle([
            'categoriesTypeProduct' => $this->category->getCategoryAll('product'),
            'categoriesTypePost' => $this->category->getCategoryAll('post')
        ]);
    }
}
