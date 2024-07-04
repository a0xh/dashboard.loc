<?php declare(strict_types=1);

namespace App\Domain\Order\Infrastructure;

use App\Domain\Order\Domain\Order;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderRepositoryInterface
{
    public function getOrder(int $count): LengthAwarePaginator;
    public function createOrder(array $data): bool;
    public function updateOrder(Order $order, array $data): bool;
    public function deleteOrder(Order $order): bool;
}
