<?php declare(strict_types=1);

namespace App\Domain\Page\Infrastructure;

use App\Domain\Page\Domain\Page;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\{Str, Collection};

class CachedPageRepository implements PageRepositoryInterface
{
    private const TTL = 1440;

    public function __construct(
        public EloquentPageRepository $pageRepository,
        public CacheManager $cache
    ) {}

    public function getPage(int $count): LengthAwarePaginator
    {
        $getPage = $this->cache->remember('pages', self::TTL, function() use($count) {
            return $this->pageRepository->getPage($count);
        });

        return $getPage;
    }

    public function createPage(array $data): bool
    {
        $createPage = $this->pageRepository->createPage($data);

        $cache = $this->cache;

        collect(['pages'])->each(function ($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $createPage;
    }

    public function updatePage(Page $page, array $data): bool
    {
        $updatePage = $this->pageRepository->updatePage($page, $data);

        $cache = $this->cache;

        collect(['pages'])->each(function ($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $updatePage;
    }

    public function deletePage(Page $page): bool
    {
        $deletePage = $this->pageRepository->deletePage($page);

        $cache = $this->cache;

        collect(['pages'])->each(function ($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $deletePage;
    }
}
