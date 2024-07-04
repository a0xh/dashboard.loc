<?php declare(strict_types=1);

namespace App\Domain\Order\Infrastructure;

use App\Domain\Order\Domain\Order;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\{Str, Collection};

class CachedOrderRepository implements OrderRepositoryInterface
{
    private const TTL = 1440;

    public function __construct(
        public EloquentOrderRepository $orderRepository,
        public CacheManager $cache
    ) {}

    public function getOrder(int $count): LengthAwarePaginator
    {
        $getOrder = $this->cache->remember('orders', self::TTL, function() use($count) {
            return $this->orderRepository->getOrder($count);
        });

        return $getOrder;
    }

    public function createOrder(array $data): bool
    {
        $createOrder = $this->orderRepository->createOrder($data);

        $cache = $this->cache;

        collect(['orders'])->each(function ($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $createOrder;
    }

    public function updateOrder(Order $order, array $data): bool
    {
        $updateOrder = $this->orderRepository->updateOrder($order, $data);

        $cache = $this->cache;

        collect(['orders'])->each(function ($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $updateOrder;
    }

    public function deleteOrder(Order $order): bool
    {
        $deleteOrder = $this->orderRepository->deleteOrder($order);

        $cache = $this->cache;

        collect(['orders'])->each(function ($item) use($cache) {
            if ($cache->has($item)) {
                return $cache->forget($item);
            }
        });

        return $deleteOrder;
    }
}
