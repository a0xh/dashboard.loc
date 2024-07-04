<?php declare(strict_types=1);

namespace App\Domain\Order\Application\Delete;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Order\Infrastructure\OrderRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Spatie\RouteAttributes\Attributes\{Delete, Where};
use App\Domain\Order\Domain\Order;

#[Where('{order:id}', '[0-9]+')]
final class DeleteOrderAction extends Controller
{
    public function __construct(
        private readonly OrderRepositoryInterface $orderRepository,
        private readonly DeleteOrderResponder $orderResponder
    ) {}

    #[Delete('/admin/order/{order:id}/delete', name: "admin.order.delete")]
    public function __invoke(Order $order): RedirectResponse
    {
        $deleteOrder = $this->orderRepository->deleteOrder($order);
        $redirectTo = $this->orderResponder->handle($deleteOrder);

        return $redirectTo;
    }
}
