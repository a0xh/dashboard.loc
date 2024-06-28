<?php declare(strict_types=1);

namespace App\Domain\Category\Infrastructure;

use App\Domain\Category\Domain\Category;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class DecoratorCategoryRepository implements CategoryRepositoryInterface
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    abstract public function getCategoryAll(string $type): array;
    abstract public function getCategoryByProduct(int $count): LengthAwarePaginator;
    abstract public function getCategoryByPost(int $count): LengthAwarePaginator;
}
