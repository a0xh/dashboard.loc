<?php declare(strict_types=1);

namespace App\Domain\Order\Infrastructure;

use App\Domain\Order\Domain\Order;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class EloquentOrderRepository extends DecoratorOrderRepository
{
    public function __construct(protected Order $order) {}

    public function getOrder(int $count): LengthAwarePaginator
    {
        return $this->order->query()->with(['product', 'user'])->orderByDesc('created_at')->paginate($count);
    }

    public function createOrder(array $data): bool
    {
        try {
            DB::transaction(function() use($data) {
                $this->order->create($data);
            }, 3);

            return $this->order->exists();
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }

    public function updateOrder(Order $order, array $data): bool
    {
        try {
            DB::transaction(function() use($order, $data) {
                $order->update($data);
            }, 3);

            return true;
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }

    public function deleteOrder(Order $order): bool
    {
        try {
            DB::transaction(function() use($order) {
                $order->delete();
            }, 3);

            if ($order->deleteOrFail() !== true) {
                return true;
            } else {
                return false;
            }
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }
}
