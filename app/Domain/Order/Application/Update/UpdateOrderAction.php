<?php declare(strict_types=1);

namespace App\Domain\Order\Application\Update;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Order\Infrastructure\OrderRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use App\Domain\Order\Domain\{Order, OrderRequest};
use Illuminate\Support\Facades\Auth;
use Spatie\RouteAttributes\Attributes\{Put, Where};
use Illuminate\Support\Collection;

#[Where('{order:id}', '[0-9]+')]
final class UpdateOrderAction extends Controller
{
    public function __construct(
        private readonly OrderRepositoryInterface $orderRepository,
        private readonly UpdateOrderResponder $orderResponder
    ) {}

    #[Put('/admin/order/{order:id}/update', name: "admin.order.update")]
    public function __invoke(Order $order, OrderRequest $orderRequest): RedirectResponse
    {
        $orderDto = literal($orderRequest->formRequest());

        $data = collect(['status' => $orderDto->getStatus()]);

        $updateOrder = $this->orderRepository->updateOrder($order, $data->merge([
            'quantity' => $order->quantity,
            'product_id' => $order->product->id,
            'user_id' => $order->user->id,
        ])->toArray());

        $redirectTo = $this->orderResponder->handle($updateOrder);

        return $redirectTo;
    }
}
