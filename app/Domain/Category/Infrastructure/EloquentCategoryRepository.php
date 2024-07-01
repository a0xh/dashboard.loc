<?php declare(strict_types=1);

namespace App\Domain\Category\Infrastructure;

use App\Domain\Category\Domain\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class EloquentCategoryRepository extends DecoratorCategoryRepository
{
    public function __construct(protected Category $category) {}

    public function getCategoryAll(string $type): array
    {
        $categories = $this->category->where('type', $type);

        return $categories->orderBy('created_at', 'desc')->get()->all();
    }

    public function getCategoryByProduct(int $count): LengthAwarePaginator
    {
        $categories = $this->category->query()->where('type', 'product')->whereNull('category_id');
        $data = ['childrenCategories', 'user'];

        return $categories->with($data)->orderByDesc('created_at')->distinct()->paginate($count);

    }

    public function getCategoryByPost(int $count): LengthAwarePaginator
    {
        $categories = $this->category->query()->where('type', 'post')->whereNull('category_id');
        $data = ['childrenCategories', 'user'];

        return $categories->with($data)->orderByDesc('created_at')->distinct()->paginate($count);
    }

    public function createCategory(array $data): bool
    {
        try {
            DB::transaction(function() use($data) {
                $this->category->create($data);
            }, 3);

            return $this->category->exists();
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }

    public function updateCategory(Category $category, array $data): bool
    {
        try {
            DB::transaction(function() use($category, $data) {
                $category->update($data);
            }, 3);

            return $category->wasChanged();
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }

    public function deleteCategory(Category $category): bool
    {
        try {
            DB::transaction(function() use($category) {
                $category->delete();
            }, 3);

            if ($category->deleteOrFail() !== true) {
                return true;
            } else {
                return false;
            }
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }
}
