<?php declare(strict_types=1);

namespace App\Domain\Subscriber\Infrastructure;

use App\Domain\Subscriber\Domain\Subscriber;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class EloquentSubscriberRepository extends DecoratorSubscriberRepository
{
    public function __construct(protected Subscriber $subscriber) {}

    public function getSubscriber(int $count): LengthAwarePaginator
    {
        return $this->subscriber->query()->orderByDesc('created_at')->paginate($count);
    }

    public function createSubscriber(array $data): bool
    {
        try {
            DB::transaction(function() use($data) {
                $this->subscriber->create($data);
            }, 3);

            return $this->subscriber->exists();
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }

    public function updateSubscriber(Subscriber $subscriber, array $data): bool
    {
        try {
            DB::transaction(function() use($subscriber, $data) {
                $subscriber->update($data);
            }, 3);

            return true;
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }

    public function deleteSubscriber(Subscriber $subscriber): bool
    {
        try {
            DB::transaction(function() use($subscriber) {
                $subscriber->delete();
            }, 3);

            if ($subscriber->deleteOrFail() !== true) {
                return true;
            } else {
                return false;
            }
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }
}
