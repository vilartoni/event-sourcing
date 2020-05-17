<?php

namespace Vilartoni\Ecommerce\Customer\Domain;

use Vilartoni\Shared\Domain\Event\DomainEvent;
use Vilartoni\Shared\Domain\Event\EventSourcingAggregateRoot;
use Vilartoni\Shared\Domain\Repository;

final class CustomerRepository extends Repository
{
    protected function createAggregate(DomainEvent ...$events): EventSourcingAggregateRoot
    {
        return new Customer($events);
    }
}
