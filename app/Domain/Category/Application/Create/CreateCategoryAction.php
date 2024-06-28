<?php declare(strict_types=1);

namespace App\Domain\Category\Application\Create;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Category\Infrastructure\CategoryRepositoryInterface;
use Spatie\RouteAttributes\Attributes\{Get, Defaults};
use App\Domain\Category\Domain\Category;

#[Defaults('type', 'product')]
#[Defaults('type', 'post')]
final class CreateCategoryAction extends Controller
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly CreateCategoryResponder $categoryResponder
    ) {}

    #[Get('/admin/category/create/{type}', name: "admin.category.create")]
    public function __invoke(): \Illuminate\View\View
    {
        $type = str_replace('admin/category/create/', '', request()->path());

        switch ($type) {
            case 'product':
                $categories = $this->categoryRepository->getCategoryAll('product');
                break;

            case 'post':
                $categories = $this->categoryRepository->getCategoryAll('post');
                break;
        }

        return $this->categoryResponder->handle([
            'categories' => $categories,
            'type' => $type
        ]);
    }
}
