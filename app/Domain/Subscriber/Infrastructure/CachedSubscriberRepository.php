<?php declare(strict_types=1);

namespace App\Domain\Subscriber\Infrastructure;

use App\Domain\Subscriber\Domain\Subscriber;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\{Str, Collection};

class CachedSubscriberRepository implements SubscriberRepositoryInterface
{
    private const TTL = 1440;

    public function __construct(
        public EloquentSubscriberRepository $subscriberRepository,
        public CacheManager $cache
    ) {}

    public function getSubscriber(int $count): LengthAwarePaginator
    {
        $getSubscriber = $this->cache->remember('subscribers', self::TTL, function() use($count) {
            return $this->subscriberRepository->getSubscriber($count);
        });

        return $getSubscriber;
    }

    public function createSubscriber(array $data): bool
    {
        $createSubscriber = $this->subscriberRepository->createSubscriber($data);

        $cache = $this->cache;

        collect(['subscribers'])->each(function ($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $createSubscriber;
    }

    public function updateSubscriber(Subscriber $subscriber, array $data): bool
    {
        $updateSubscriber = $this->subscriberRepository->updateSubscriber($subscriber, $data);

        $cache = $this->cache;

        collect(['subscribers'])->each(function ($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $updateSubscriber;
    }

    public function deleteSubscriber(Subscriber $subscriber): bool
    {
        $deleteSubscriber = $this->subscriberRepository->deleteSubscriber($subscriber);

        $cache = $this->cache;

        collect(['subscribers'])->each(function ($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $deleteSubscriber;
    }
}
