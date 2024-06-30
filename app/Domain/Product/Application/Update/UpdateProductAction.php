<?php declare(strict_types=1);

namespace App\Domain\Product\Application\Update;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Product\Infrastructure\ProductRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use App\Domain\Product\Domain\{Product, ProductRequest};
use Illuminate\Support\Facades\Auth;
use Spatie\RouteAttributes\Attributes\{Put, Where};
use Illuminate\Support\Collection;
use App\Application\Traits\MediaAction;

#[Where('{product:id}', '[0-9]+')]
final class UpdateProductAction extends Controller
{
    use MediaAction;

    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly UpdateProductResponder $productResponder
    ) {}

    #[Put('/admin/product/{product:id}/update', name: "admin.product.update")]
    public function __invoke(Product $product, ProductRequest $productRequest): RedirectResponse
    {
        $productDto = literal($productRequest->formRequest());

        $updateMedia = $this->updateMedia($product->media, $productDto->getMedia());

        $data = collect([
            'title' => $productDto->getTitle(),
            'description' => $productDto->getDescription(),
            'slug' => $productDto->getSlug(),
            'category_id' => $productDto->getCategoryId(),
            'status' => $productDto->getStatus(),
            'content' => $productDto->getContent(),
            'price' => $productDto->getPrice(),
            'keywords' => $productDto->getKeywords(),
            'data' => $productDto->getData(),
            'tag_id' => $productDto->getTagId()
        ]);

        $updateProduct = $this->productRepository->updateProduct($product, $data->merge([
            'media' => $updateMedia, 'user_id' => $product->user_id
        ])->toArray());

        $redirectTo = $this->productResponder->handle($updateProduct);

        return $redirectTo;
    }
}
