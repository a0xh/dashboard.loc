<?php declare(strict_types=1);

namespace App\Domain\Post\Infrastructure;

use App\Domain\Post\Domain\Post;
use Illuminate\Pagination\LengthAwarePaginator;

interface PostRepositoryInterface
{
    public function getPost(int $count): LengthAwarePaginator;
    public function createPost(array $data): bool;
    public function updatePost(Post $post, array $data): bool;
    public function deletePost(Post $post): bool;
}
