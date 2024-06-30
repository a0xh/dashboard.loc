<?php declare(strict_types=1);

namespace App\Domain\Product\Infrastructure;

use App\Domain\Product\Domain\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class EloquentProductRepository extends DecoratorProductRepository
{
    public function __construct(protected Product $product) {}

    public function getProduct(int $count): LengthAwarePaginator
    {
        return $this->product->query()->with(['user', 'category', 'tags'])->orderByDesc('created_at')->paginate($count);
    }

    public function createProduct(array $data): bool
    {
        try {
            DB::transaction(function() use($data) {
                $tagId = $data['tag_id'];

                $product = $this->product->create(data_forget($data, 'tag_id'));
                $product->tags()->sync($tagId);
            }, 3);

            return $this->product->exists();
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }

    public function updateProduct(Product $product, array $data): bool
    {
        try {
            DB::transaction(function() use($product, $data) {
                $tagId = $data['tag_id'];

                $product->update(data_forget($data, 'tag_id'));
                $product->tags()->sync($tagId);
            }, 3);

            return true;
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }

    public function deleteProduct(Product $product): bool
    {
        try {
            DB::transaction(function() use($product) {
                $product->tags()->detach();
                $product->delete();
            }, 3);

            if ($product->deleteOrFail() !== true) {
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
