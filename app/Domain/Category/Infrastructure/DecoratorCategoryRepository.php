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

    abstract public function getCategoryAll(string $type): Category;
    abstract public function getCategory(string $type, int $count): LengthAwarePaginator;
}
