<?php declare(strict_types=1);

namespace App\Domain\Subscriber\Infrastructure;

use App\Domain\Subscriber\Domain\Subscriber;
use Illuminate\Pagination\LengthAwarePaginator;

interface SubscriberRepositoryInterface
{
    public function getSubscriber(int $count): LengthAwarePaginator;
    public function createSubscriber(array $data): bool;
    public function updateSubscriber(Subscriber $subscriber, array $data): bool;
    public function deleteSubscriber(Subscriber $subscriber): bool;
}
