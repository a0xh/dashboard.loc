<?php declare(strict_types=1);

namespace App\Domain\Subscriber\Application\Index;

use App\Infrastructure\Controllers\Controller;
use App\Domain\Subscriber\Infrastructure\SubscriberRepositoryInterface;
use Spatie\RouteAttributes\Attributes\Get;
use App\Domain\Subscriber\Domain\Subscriber;

final class IndexSubscriberAction extends Controller
{
    public function __construct(
        private readonly SubscriberRepositoryInterface $subscriberRepository,
        private readonly IndexSubscriberResponder $subscriberResponder
    ) {}

    #[Get('/admin/subscriber', name: 'admin.subscriber.index')]
    public function __invoke(): \Illuminate\View\View
    {
        return $this->subscriberResponder->handle([
            'subscribers' => $this->subscriberRepository->getSubscriber(11)
        ]);
    }
}
