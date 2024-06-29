<?php declare(strict_types=1);

namespace App\Domain\Category\Infrastructure;

abstract class DecoratorCategoryRepository implements CategoryRepositoryInterface
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }
}
