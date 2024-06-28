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

    public function getCategoryAll(string $type): Category
    {
        $getCategoryAll = $this->cache->remember('category_' . $type, self::TTL, function() use($type) {
            return $this->categoryRepository->getCategoryAll($type);
        });

        return $getCategoryAll;
    }

    public function getCategory(string $type, int $count): LengthAwarePaginator
    {
        $getCategory = $this->cache->remember('categories', self::TTL, function() use($type, $count) {
            return $this->categoryRepository->getCategory($type, $count);
        });

        return $getCategory;
    }

    public function createCategory(array $data): bool
    {
        $createCategory = $this->categoryRepository->createCategory($data);

        if ($this->cache->has('categories')) {
            $this->cache->pull('categories');
        }

        return $createCategory;
    }

    public function updateCategory(Category $category, array $data): bool
    {
        $updateCategory = $this->categoryRepository->updateCategory($category, $data);

        if ($this->cache->has('categories')) {
            $this->cache->pull('categories');
        }

        return $updateCategory;
    }

    public function deleteCategory(Category $category): bool
    {
        $deleteCategory = $this->categoryRepository->deleteCategory($category);

        if ($this->cache->has('categories')) {
            $this->cache->forget('categories');
        }

        return $deleteCategory;
    }
}
