<?php declare(strict_types=1);

namespace App\Domain\Tag\Infrastructure;

use App\Domain\Tag\Domain\Tag;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\{Str, Collection};

class CachedTagRepository implements TagRepositoryInterface
{
    private const TTL = 1440;

    public function __construct(
        public EloquentTagRepository $tagRepository,
        public CacheManager $cache
    ) {}

    public function getTagAll(string $type): array
    {
        $key = Str::of('tag_')->append($type)->finish('_all');

        $getTagAll = $this->cache->remember($key, self::TTL, function() use($type) {
            return $this->tagRepository->getTagAll($type);
        });

        return $getTagAll;
    }

    public function getTagByProduct(int $count): LengthAwarePaginator
    {
        $key = Str::of('tag')->append('_')->finish('product');

        $getTagByProduct = $this->cache->remember($key, self::TTL, function() use($count) {
            return $this->tagRepository->getTagByProduct($count);
        });

        return $getTagByProduct;
    }

    public function getTagByPost(int $count): LengthAwarePaginator
    {
        $key = Str::of('tag')->append('_')->finish('post');

        $getTagByPost = $this->cache->remember($key, self::TTL, function() use($count) {
            return $this->tagRepository->getTagByPost($count);
        });

        return $getTagByPost;
    }

    public function createTag(array $data): bool
    {
        $createTag = $this->tagRepository->createTag($data);

        $cleanCache = collect(['tag_post', 'tag_product']);
        $cache = $this->cache;

        $cleanCache->each(function ($item) use($cache) {
            if ($cache->has(Str::of($item)->finish('_all'))) {
                return $cache->forget(Str::of($item)->finish('_all'));
            }
        })->each(function($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $createTag;
    }

    public function updateTag(Tag $tag, array $data): bool
    {
        $updateTag = $this->tagRepository->updateTag($tag, $data);

        $cleanCache = collect(['tag_post', 'tag_product']);
        $cache = $this->cache;

        $cleanCache->each(function ($item) use($cache) {
            if ($cache->has(Str::of($item)->finish('_all'))) {
                return $cache->forget(Str::of($item)->finish('_all'));
            }
        })->each(function($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $updateTag;
    }

    public function deleteTag(Tag $tag): bool
    {
        $deleteTag = $this->tagRepository->deleteTag($tag);

        $cleanCache = collect(['tag_post', 'tag_product']);
        $cache = $this->cache;

        $cleanCache->each(function ($item) use($cache) {
            if ($cache->has(Str::of($item)->finish('_all'))) {
                return $cache->forget(Str::of($item)->finish('_all'));
            }
        })->each(function($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $deleteTag;
    }
}
