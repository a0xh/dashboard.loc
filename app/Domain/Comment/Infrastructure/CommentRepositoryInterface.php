<?php declare(strict_types=1);

namespace App\Domain\Comment\Infrastructure;

use App\Domain\Comment\Domain\Comment;
use Illuminate\Pagination\LengthAwarePaginator;

interface CommentRepositoryInterface
{
    public function getCommentByProduct(int $count): LengthAwarePaginator;
    public function getCommentByPost(int $count): LengthAwarePaginator;
    public function createComment(array $data): bool;
    public function updateComment(Comment $comment, array $data): bool;
    public function deleteComment(Comment $comment): bool;
}
