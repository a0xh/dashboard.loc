<?php declare(strict_types=1);

namespace App\Domain\Comment\Infrastructure;

abstract class DecoratorCommentRepository implements CommentRepositoryInterface
{
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository) {
        $this->commentRepository = $commentRepository;
    }
}
