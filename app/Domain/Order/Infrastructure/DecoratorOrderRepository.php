<?php declare(strict_types=1);

namespace App\Domain\Order\Infrastructure;

abstract class DecoratorOrderRepository implements OrderRepositoryInterface
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository) {
        $this->orderRepository = $orderRepository;
    }
}
