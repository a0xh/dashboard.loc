<?php declare(strict_types=1);

namespace App\Domain\Category\Infrastructure;

use App\Domain\Category\Domain\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class EloquentCategoryRepository extends DecoratorCategoryRepository
{
    public function __construct(protected Category $category) {}

    public function getCategoryAll(string $type): Category
    {
        return $this->category->where('type', $type)->orderBy('created_at', 'desc')->get()->all();
    }

    public function getCategory(string $type, int $count): LengthAwarePaginator
    {
        return $this->category->query()->whereNull('category_id')->with(['childrenCategories', 'user'])->where('type', $type)->orderByDesc('created_at')->paginate($count);
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
