<?php declare(strict_types=1);

namespace App\Domain\Product\Application\Create;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Product\Infrastructure\ProductRepositoryInterface;
use App\Domain\Category\Infrastructure\CategoryRepositoryInterface;
use App\Domain\Tag\Infrastructure\TagRepositoryInterface;
use App\Domain\Product\Domain\Product;
use Spatie\RouteAttributes\Attributes\Get;

final class CreateProductAction extends Controller
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly TagRepositoryInterface $tagRepository,
        private readonly CreateProductResponder $productResponder
    ) {}

    #[Get('/admin/product/create', name: "admin.product.create")]
    public function __invoke(): \Illuminate\View\View
    {
        $tags = $this->tagRepository->getTagAll('product');
        $categories = $this->categoryRepository->getCategoryAll('product');

        return $this->productResponder->handle([
            'categories' => $categories,
            'tags' => $tags
        ]);
    }
}
