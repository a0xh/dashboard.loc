<?php declare(strict_types=1);

namespace App\Domain\Product\Application\Delete;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Product\Infrastructure\ProductRepositoryInterface;
use App\Application\Traits\MediaAction;
use Spatie\RouteAttributes\Attributes\{Delete, Where};
use Illuminate\Http\RedirectResponse;
use App\Domain\Product\Domain\Product;

#[Where('{product:id}', '[0-9]+')]
final class DeleteProductAction extends Controller
{
    use MediaAction;

    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly DeleteProductResponder $productResponder
    ) {}

    #[Delete('/admin/product/{product:id}/delete', name: "admin.product.delete")]
    public function __invoke(Product $product): RedirectResponse
    {
        if ($product->media) {
            $this->deleteMedia($product->media);
        }

        $deleteProduct = $this->productRepository->deleteProduct($product);
        $redirectTo = $this->productResponder->handle($deleteProduct);

        return $redirectTo;
    }
}
