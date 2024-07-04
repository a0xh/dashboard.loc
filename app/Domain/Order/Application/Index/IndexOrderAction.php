<?php declare(strict_types=1);

namespace App\Domain\Order\Application\Index;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Order\Infrastructure\OrderRepositoryInterface;
use App\Domain\Order\Domain\Order;
use Spatie\RouteAttributes\Attributes\Get;

final class IndexOrderAction extends Controller
{
    public function __construct(
        private readonly OrderRepositoryInterface $orderRepository,
        private readonly IndexOrderResponder $orderResponder
    ) {}

    #[Get('/admin/order', name: 'admin.order.index')]
    public function __invoke(): \Illuminate\View\View
    {
        return $this->orderResponder->handle([
            'orders' => $this->orderRepository->getOrder(11),
        ]);
    }
}
