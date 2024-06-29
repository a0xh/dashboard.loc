<?php declare(strict_types=1);

namespace App\Domain\Category\Infrastructure;

use App\Domain\Category\Domain\Category;
use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryRepositoryInterface
{
    public function getCategoryAll(string $type): array;
    public function getCategoryByProduct(int $count): LengthAwarePaginator;
    public function getCategoryByPost(int $count): LengthAwarePaginator;
    public function createCategory(array $data): bool;
    public function updateCategory(Category $category, array $data): bool;
    public function deleteCategory(Category $category): bool;
}
