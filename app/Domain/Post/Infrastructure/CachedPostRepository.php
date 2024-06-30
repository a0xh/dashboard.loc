<?php declare(strict_types=1);

namespace App\Domain\Post\Infrastructure;

use App\Domain\Post\Domain\Post;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\{Str, Collection};

class CachedPostRepository implements PostRepositoryInterface
{
    private const TTL = 1440;

    public function __construct(
        public EloquentPostRepository $postRepository,
        public CacheManager $cache
    ) {}

    public function getPost(int $count): LengthAwarePaginator
    {
        $getPost = $this->cache->remember('posts', self::TTL, function() use($count) {
            return $this->postRepository->getPost($count);
        });

        return $getPost;
    }

    public function createPost(array $data): bool
    {
        $createPost = $this->postRepository->createPost($data);

        $cache = $this->cache;

        collect(['posts'])->each(function ($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $createPost;
    }

    public function updatePost(Post $post, array $data): bool
    {
        $updatePost = $this->postRepository->updatePost($post, $data);

        $cache = $this->cache;

        collect(['posts'])->each(function ($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $updatePost;
    }

    public function deletePost(Post $post): bool
    {
        $deletePost = $this->postRepository->deletePost($post);

        $cache = $this->cache;

        collect(['posts'])->each(function ($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $deletePost;
    }
}
