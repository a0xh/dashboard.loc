<?php declare(strict_types=1);

namespace App\Domain\Subscriber\Application\Store;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Subscriber\Infrastructure\SubscriberRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use App\Domain\Subscriber\Domain\SubscriberRequest;
use Spatie\RouteAttributes\Attributes\Post;
use Illuminate\Support\Collection;

final class StoreSubscriberAction extends Controller
{
    public function __construct(
        private readonly SubscriberRepositoryInterface $subscriberRepository,
        private readonly StoreSubscriberResponder $subscriberResponder
    ) {}

    #[Post('/admin/subscriber/store', name: "admin.subscriber.store")]
    public function __invoke(SubscriberRequest $subscriberRequest): RedirectResponse
    {
        $subscriberDto = literal($subscriberRequest->formRequest());

        $data = collect([
            'email' => $subscriberDto->getEmail(),
            'data' => $subscriberDto->getData()
        ]);

        $createSubscriber = $this->subscriberRepository->createSubscriber(
            $data->merge(['status' => true])->toArray()
        );

        $redirectTo = $this->subscriberResponder->handle($createSubscriber);

        return $redirectTo;
    }
}
