<?php declare(strict_types=1);

namespace App\Domain\Subscriber\Application\Update;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Subscriber\Infrastructure\SubscriberRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use App\Domain\Subscriber\Domain\{Subscriber, SubscriberRequest};
use Spatie\RouteAttributes\Attributes\{Put, Where};
use Illuminate\Support\Collection;

#[Where('{subscriber:id}', '[0-9]+')]
final class UpdateSubscriberAction extends Controller
{
    public function __construct(
        private readonly SubscriberRepositoryInterface $subscriberRepository,
        private readonly UpdateSubscriberResponder $subscriberResponder
    ) {}

    #[Put('/admin/subscriber/{subscriber:id}/update', name: "admin.subscriber.update")]
    public function __invoke(Subscriber $subscriber, SubscriberRequest $subscriberRequest): RedirectResponse
    {
        $subscriberDto = literal($subscriberRequest->formRequest());

        $data = collect([
            'status' => $subscriberDto->getStatus(),
            'data' => $subscriberDto->getData()
        ]);

        $updateSubscriber = $this->subscriberRepository->updateSubscriber($subscriber,
            $data->merge(['email' => $subscriber->email])->toArray()
        );

        $redirectTo = $this->subscriberResponder->handle($updateSubscriber);

        return $redirectTo;
    }
}
