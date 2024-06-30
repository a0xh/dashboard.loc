<?php declare(strict_types=1);

namespace App\Domain\Product\Application\Edit;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Product\Infrastructure\ProductRepositoryInterface;
use App\Domain\Category\Infrastructure\CategoryRepositoryInterface;
use App\Domain\Tag\Infrastructure\TagRepositoryInterface;
use Spatie\RouteAttributes\Attributes\{Get, Where};
use App\Domain\Product\Domain\Product;

#[Where('{product:id}', '[0-9]+')]
final class EditProductAction extends Controller
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly TagRepositoryInterface $tagRepository,
        private readonly EditProductResponder $productResponder
    ) {}

    #[Get('/admin/product/{product:id}/edit', name: "admin.product.edit")]
    public function __invoke(Product $product): \Illuminate\View\View
    {
        $tags = $this->tagRepository->getTagAll('product');
        $categories = $this->categoryRepository->getCategoryAll('product');

        return $this->productResponder->handle([
            'categories' => $categories,
            'tags' => $tags,
            'product' => $product
        ]);
    }
}
