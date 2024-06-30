<?php declare(strict_types=1);

namespace App\Domain\Product\Infrastructure;

abstract class DecoratorProductRepository implements ProductRepositoryInterface
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }
}
