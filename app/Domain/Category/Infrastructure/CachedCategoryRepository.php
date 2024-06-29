<?php declare(strict_types=1);

namespace App\Domain\Category\Infrastructure;

use App\Domain\Category\Domain\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\{Str, Collection};

class CachedCategoryRepository implements CategoryRepositoryInterface
{
    private const TTL = 1440;
    private const KEY = ['category_post', 'category_product'];

    public function __construct(
        public EloquentCategoryRepository $categoryRepository,
        public CacheManager $cache
    ) {}

    public function getCategoryAll(string $type): array
    {
        $key = Str::of('category')->finish('_')->append($type)->append('_')->finish('all');

        $getCategoryAll = $this->cache->remember($key, self::TTL, function() use($type) {
            return $this->categoryRepository->getCategoryAll($type);
        });

        return $getCategoryAll;
    }

    public function getCategoryByProduct(int $count): LengthAwarePaginator
    {
        $getCategoryByProduct = $this->cache->remember(self::KEY[1], self::TTL, function() use($count) {
            return $this->categoryRepository->getCategoryByProduct($count);
        });

        return $getCategoryByProduct;
    }

    public function getCategoryByPost(int $count): LengthAwarePaginator
    {
        $getCategoryByPost = $this->cache->remember(self::KEY[0], self::TTL, function() use($count) {
            return $this->categoryRepository->getCategoryByPost($count);
        });

        return $getCategoryByPost;
    }

    public function createCategory(array $data): bool
    {
        $createCategory = $this->categoryRepository->createCategory($data);

        $cache = $this->cache;

        collect(self::KEY)->each(function ($item) use($cache) {
            if ($cache->has(Str::of($item)->finish('_all'))) {
                return $cache->forget(Str::of($item)->append('_')->finish('all'));
            }
        })->each(function($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget(Str::of($item));
            }
        });

        return $createCategory;
    }

    public function updateCategory(Category $category, array $data): bool
    {
        $updateCategory = $this->categoryRepository->updateCategory($category, $data);

        $cache = $this->cache;

        collect(self::KEY)->each(function ($item) use($cache) {
            if ($cache->has($item . '_all')) {
                return $cache->forget(Str::of($item)->append('_')->finish('all'));
            }
        })->each(function($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget(Str::of($item));
            }
        });

        return $updateCategory;
    }

    public function deleteCategory(Category $category): bool
    {
        $deleteCategory = $this->categoryRepository->deleteCategory($category);

        $cache = $this->cache;

        collect(self::KEY)->each(function ($item) use($cache) {
            if ($cache->has($item . '_all')) {
                return $cache->forget(Str::of($item)->append('_')->finish('all'));
            }
        })->each(function($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget(Str::of($item));
            }
        });

        return $deleteCategory;
    }
}
