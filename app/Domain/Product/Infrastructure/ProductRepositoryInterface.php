<?php declare(strict_types=1);

namespace App\Domain\Product\Infrastructure;

use App\Domain\Product\Domain\Product;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    public function getProduct(int $count): LengthAwarePaginator;
    public function createProduct(array $data): bool;
    public function updateProduct(Product $product, array $data): bool;
    public function deleteProduct(Product $product): bool;
}
