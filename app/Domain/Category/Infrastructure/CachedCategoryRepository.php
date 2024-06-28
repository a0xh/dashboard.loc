<?php declare(strict_types=1);

namespace App\Domain\Category\Infrastructure;

use App\Domain\Category\Domain\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Cache\CacheManager;

class CachedCategoryRepository implements CategoryRepositoryInterface
{
    protected const TTL = 1440;

    public function __construct(
        protected EloquentCategoryRepository $categoryRepository,
        protected CacheManager $cache
    ) {}

    public function getCategoryAll(string $type): array
    {
        $getCategoryAll = $this->cache->remember('category_' . $type, self::TTL, function() use($type) {
            return $this->categoryRepository->getCategoryAll($type);
        });

        return $getCategoryAll;
    }

    public function getCategoryByProduct(int $count): LengthAwarePaginator
    {
        $getCategoryByProduct = $this->cache->remember('categories_product', self::TTL, function() use($count) {
            return $this->categoryRepository->getCategoryByProduct($count);
        });

        return $getCategoryByProduct;
    }

    public function getCategoryByPost(int $count): LengthAwarePaginator
    {
        $getCategoryByPost = $this->cache->remember('categories_post', self::TTL, function() use($count) {
            return $this->categoryRepository->getCategoryByPost($count);
        });

        return $getCategoryByPost;
    }

    public function createCategory(array $data): bool
    {
        $createCategory = $this->categoryRepository->createCategory($data);

        if ($this->cache->has('categories_post')) {
            $this->cache->pull('categories_post');
        }

        if ($this->cache->has('categories_product')) {
            $this->cache->pull('categories_product');
        }

        if ($this->cache->has('category_product')) {
            $this->cache->pull('category_product');
        }

        if ($this->cache->has('category_post')) {
            $this->cache->pull('category_post');
        }

        return $createCategory;
    }

    public function updateCategory(Category $category, array $data): bool
    {
        $updateCategory = $this->categoryRepository->updateCategory($category, $data);

        if ($this->cache->has('categories_post')) {
            $this->cache->pull('categories_post');
        }

        if ($this->cache->has('categories_product')) {
            $this->cache->pull('categories_product');
        }

        if ($this->cache->has('category_product')) {
            $this->cache->pull('category_product');
        }

        if ($this->cache->has('category_post')) {
            $this->cache->pull('category_post');
        }

        return $updateCategory;
    }

    public function deleteCategory(Category $category): bool
    {
        $deleteCategory = $this->categoryRepository->deleteCategory($category);

        if ($this->cache->has('categories_post')) {
            $this->cache->forget('categories_post');
        }

        if ($this->cache->has('categories_product')) {
            $this->cache->forget('categories_product');
        }

        if ($this->cache->has('category_product')) {
            $this->cache->forget('category_product');
        }

        if ($this->cache->has('category_post')) {
            $this->cache->forget('category_post');
        }

        return $deleteCategory;
    }
}
