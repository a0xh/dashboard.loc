<?php declare(strict_types=1);

namespace App\Domain\Product\Application\Index;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Product\Infrastructure\ProductRepositoryInterface;
use Spatie\RouteAttributes\Attributes\Get;
use App\Domain\Product\Domain\Product;

final class IndexProductAction extends Controller
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly IndexProductResponder $productResponder
    ) {}

    #[Get('/admin/product', name: 'admin.product.index')]
    public function __invoke(): \Illuminate\View\View
    {
        return $this->productResponder->handle([
            'products' => $this->productRepository->getProduct(11)
        ]);
    }
}
