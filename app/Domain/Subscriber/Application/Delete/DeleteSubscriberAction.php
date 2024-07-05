<?php declare(strict_types=1);

namespace App\Domain\Subscriber\Application\Delete;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Subscriber\Infrastructure\SubscriberRepositoryInterface;
use Spatie\RouteAttributes\Attributes\{Delete, Where};
use App\Domain\Subscriber\Domain\Subscriber;
use Illuminate\Http\RedirectResponse;

#[Where('{subscriber:id}', '[0-9]+')]
final class DeleteSubscriberAction extends Controller
{
    public function __construct(
        private readonly SubscriberRepositoryInterface $subscriberRepository,
        private readonly DeleteSubscriberResponder $subscriberResponder
    ) {}

    #[Delete('/admin/subscriber/{subscriber:id}/delete', name: "admin.subscriber.delete")]
    public function __invoke(Subscriber $subscriber): RedirectResponse
    {
        $deleteSubscriber = $this->subscriberRepository->deleteSubscriber($subscriber);
        $redirectTo = $this->subscriberResponder->handle($deleteSubscriber);

        return $redirectTo;
    }
}
