<?php declare(strict_types=1);

namespace App\Domain\Category\Application\Index;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Category\Infrastructure\CategoryRepositoryInterface;
use App\Domain\Category\Domain\Category;
use Spatie\RouteAttributes\Attributes\Get;
use Illuminate\Support\{Str, Collection};

final class IndexCategoryAction extends Controller
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly IndexCategoryResponder $categoryResponder
    ) {}

    #[Get('/admin/category', name: 'admin.category.index')]
    public function __invoke(): \Illuminate\View\View
    {
        return $this->categoryResponder->handle([
            'categoriesTypeProduct' => $this->categoryRepository->getCategoryByProduct(11),
            'categoriesTypePost' => $this->categoryRepository->getCategoryByPost(11)
        ]);
    }
}
