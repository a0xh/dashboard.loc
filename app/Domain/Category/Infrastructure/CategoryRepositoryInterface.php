<?php declare(strict_types=1);

namespace App\Domain\Category\Infrastructure;

use App\Domain\Category\Domain\Category;

interface CategoryRepositoryInterface
{
    public function createCategory(array $data): bool;
    public function updateCategory(Category $category, array $data): bool;
    public function deleteCategory(Category $category): bool;
}
