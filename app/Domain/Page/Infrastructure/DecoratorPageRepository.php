<?php declare(strict_types=1);

namespace App\Domain\Page\Infrastructure;

abstract class DecoratorPageRepository implements PageRepositoryInterface
{
    protected $pageRepository;

    public function __construct(PageRepositoryInterface $pageRepository) {
        $this->pageRepository = $pageRepository;
    }
}
