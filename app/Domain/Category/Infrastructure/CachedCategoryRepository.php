<?php declare(strict_types=1);

namespace App\Domain\Category\Infrastructure;

use App\Domain\Category\Domain\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\{Str, Collection};

class CachedCategoryRepository implements CategoryRepositoryInterface
{
    private const TTL = 1440;

    public function __construct(
        public EloquentCategoryRepository $categoryRepository,
        public CacheManager $cache
    ) {}

    public function getCategoryAll(string $type): array
    {
        $key = Str::of('category_')->append($type)->finish('_all');

        $getCategoryAll = $this->cache->remember($key, self::TTL, function() use($type) {
            return $this->categoryRepository->getCategoryAll($type);
        });

        return $getCategoryAll;
    }

    public function getCategoryByProduct(int $count): LengthAwarePaginator
    {
        $key = Str::of('category')->append('_')->finish('product');

        $getCategoryByProduct = $this->cache->remember($key, self::TTL, function() use($count) {
            return $this->categoryRepository->getCategoryByProduct($count);
        });

        return $getCategoryByProduct;
    }

    public function getCategoryByPost(int $count): LengthAwarePaginator
    {
        $key = Str::of('category')->append('_')->finish('post');

        $getCategoryByPost = $this->cache->remember($key, self::TTL, function() use($count) {
            return $this->categoryRepository->getCategoryByPost($count);
        });

        return $getCategoryByPost;
    }

    public function createCategory(array $data): bool
    {
        $createCategory = $this->categoryRepository->createCategory($data);

        $cleanCache = collect(['category_post', 'category_product']);
        $cache = $this->cache;

        $cleanCache->each(function ($item) use($cache) {
            if ($cache->has(Str::of($item)->finish('_all'))) {
                return $cache->forget(Str::of($item)->finish('_all'));
            }
        })->each(function($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $createCategory;
    }

    public function updateCategory(Category $category, array $data): bool
    {
        $updateCategory = $this->categoryRepository->updateCategory($category, $data);

        $cleanCache = collect(['category_post', 'category_product']);
        $cache = $this->cache;

        $cleanCache->each(function ($item) use($cache) {
            if ($cache->has(Str::of($item)->finish('_all'))) {
                return $cache->forget(Str::of($item)->finish('_all'));
            }
        })->each(function($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $updateCategory;
    }

    public function deleteCategory(Category $category): bool
    {
        $deleteCategory = $this->categoryRepository->deleteCategory($category);

        $cleanCache = collect(['category_post', 'category_product']);
        $cache = $this->cache;

        $cleanCache->each(function ($item) use($cache) {
            if ($cache->has(Str::of($item)->finish('_all'))) {
                return $cache->forget(Str::of($item)->finish('_all'));
            }
        })->each(function($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $deleteCategory;
    }
}
