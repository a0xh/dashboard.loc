<?php declare(strict_types=1);

namespace App\Domain\Comment\Infrastructure;

use App\Domain\Comment\Domain\Comment;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\{Str, Collection};

class CachedCommentRepository implements CommentRepositoryInterface
{
    private const TTL = 1440;

    public function __construct(
        public EloquentCommentRepository $commentRepository,
        public CacheManager $cache
    ) {}

    public function getCommentByProduct(int $count): LengthAwarePaginator
    {
        $key = Str::of('comment')->append('_')->finish('product');

        $getCommentByProduct = $this->cache->remember($key, self::TTL, function() use($count) {
            return $this->commentRepository->getCommentByProduct($count);
        });

        return $getCommentByProduct;
    }

    public function getCommentByPost(int $count): LengthAwarePaginator
    {
        $key = Str::of('comment')->append('_')->finish('post');

        $getCommentByPost = $this->cache->remember($key, self::TTL, function() use($count) {
            return $this->commentRepository->getCommentByPost($count);
        });

        return $getCommentByPost;
    }

    public function createComment(array $data): bool
    {
        $createComment = $this->commentRepository->createComment($data);

        $cache = $this->cache;
        $cleanCache = collect(['comment_post', 'comment_product']);

        $cleanCache->each(function($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $createComment;
    }

    public function updateComment(Comment $comment, array $data): bool
    {
        $updateComment = $this->commentRepository->updateComment($comment, $data);

        $cache = $this->cache;
        $cleanCache = collect(['comment_post', 'comment_product']);

        $cleanCache->each(function($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $updateComment;
    }

    public function deleteComment(Comment $comment): bool
    {
        $deleteComment = $this->commentRepository->deleteComment($comment);

        $cache = $this->cache;
        $cleanCache = collect(['comment_post', 'comment_product']);

        $cleanCache->each(function($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $deleteComment;
    }
}
