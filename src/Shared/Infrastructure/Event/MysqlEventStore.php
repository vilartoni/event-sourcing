<?php

namespace Vilartoni\Shared\Infrastructure\Event;

use Vilartoni\Shared\Domain\Event\DomainEvent;
use Vilartoni\Shared\Domain\Event\EventStore;
use Vilartoni\Shared\Domain\Event\EventStream;
use Vilartoni\Shared\Domain\Identity\UniqueIdentifier;

final class MysqlEventStore implements EventStore
{
    public function loadEventStreamForId(UniqueIdentifier $id): ?EventStream
    {
        // TODO: Implement loadEventStreamForId() method.
    }

    public function appendToStream(UniqueIdentifier $id, DomainEvent ...$events): void
    {
        // TODO: Implement appendToStream() method.
    }
}
