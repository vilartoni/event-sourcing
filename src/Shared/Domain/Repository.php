<?php

namespace Vilartoni\Shared\Domain;

use Vilartoni\Shared\Domain\Event\DomainEvent;
use Vilartoni\Shared\Domain\Event\EventSourcingAggregateRoot;
use Vilartoni\Shared\Domain\Event\EventStore;
use Vilartoni\Shared\Domain\Identity\UniqueIdentifier;

abstract class Repository
{
    private EventStore $eventStore;

    public function __construct(EventStore $eventStore)
    {
        $this->eventStore = $eventStore;
    }

    public function search(UniqueIdentifier $id): ?EventSourcingAggregateRoot
    {
        $eventStream = $this->eventStore->loadEventStreamForId($id);

        if (is_null($eventStream)) {
            return null;
        }

        return $this->createAggregate(
            ...$eventStream->events()
        );
    }

    abstract protected function createAggregate(DomainEvent ...$events): EventSourcingAggregateRoot;

    public function save(EventSourcingAggregateRoot $aggregate): void
    {
        $this->eventStore->appendToStream($aggregate->id(), $aggregate->newEvents());
    }
}
