<?php declare(strict_types=1);

namespace App\Domain\Product\Infrastructure;

use App\Domain\Product\Domain\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\{Str, Collection};

class CachedProductRepository implements ProductRepositoryInterface
{
    private const TTL = 1440;

    public function __construct(
        public EloquentProductRepository $productRepository,
        public CacheManager $cache
    ) {}

    public function getProduct(int $count): LengthAwarePaginator
    {
        $getProduct = $this->cache->remember('products', self::TTL, function() use($count) {
            return $this->productRepository->getProduct($count);
        });

        return $getProduct;
    }

    public function createProduct(array $data): bool
    {
        $createProduct = $this->productRepository->createProduct($data);

        $cache = $this->cache;

        collect(['products'])->each(function ($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $createProduct;
    }

    public function updateProduct(Product $product, array $data): bool
    {
        $updateProduct = $this->productRepository->updateProduct($product, $data);

        $cache = $this->cache;

        collect(['products'])->each(function ($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $updateProduct;
    }

    public function deleteProduct(Product $product): bool
    {
        $deleteProduct = $this->productRepository->deleteProduct($product);

        $cache = $this->cache;

        collect(['products'])->each(function ($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $deleteProduct;
    }
}
