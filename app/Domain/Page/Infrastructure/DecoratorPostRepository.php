<?php declare(strict_types=1);

namespace App\Domain\Post\Infrastructure;

abstract class DecoratorPostRepository implements PostRepositoryInterface
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository) {
        $this->postRepository = $postRepository;
    }
}
