<?php declare(strict_types=1);

namespace App\Domain\Product\Application\Store;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Product\Infrastructure\ProductRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use App\Domain\Product\Domain\ProductRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\RouteAttributes\Attributes\Post;
use Illuminate\Support\Collection;
use App\Application\Traits\MediaAction;

final class StoreProductAction extends Controller
{
    use MediaAction;

    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly StoreProductResponder $productResponder
    ) {}

    #[Post('/admin/product/store', name: "admin.product.store")]
    public function __invoke(ProductRequest $productRequest): RedirectResponse
    {
        $productDto = literal($productRequest->formRequest());

        $createMedia = $this->createMedia($productDto->getMedia());

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

        $createProduct = $this->productRepository->createProduct($data->merge([
            'user_id' => Auth::user()->id, 'media' => $createMedia
        ])->toArray());

        $redirectTo = $this->productResponder->handle($createProduct);

        return $redirectTo;
    }
}
