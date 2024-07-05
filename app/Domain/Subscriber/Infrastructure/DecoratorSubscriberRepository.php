<?php declare(strict_types=1);

namespace App\Domain\Subscriber\Infrastructure;

abstract class DecoratorSubscriberRepository implements SubscriberRepositoryInterface
{
    protected $subscriberRepository;

    public function __construct(SubscriberRepositoryInterface $subscriberRepository) {
        $this->subscriberRepository = $subscriberRepository;
    }
}
