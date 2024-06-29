<?php declare(strict_types=1);

namespace App\Domain\Tag\Infrastructure;

abstract class DecoratorTagRepository implements TagRepositoryInterface
{
    protected $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository) {
        $this->tagRepository = $tagRepository;
    }
}
