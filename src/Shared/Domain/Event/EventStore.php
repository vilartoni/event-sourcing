<?php

namespace Vilartoni\Shared\Domain\Event;

use Vilartoni\Shared\Domain\Identity\UniqueIdentifier;

interface EventStore
{
    public function loadEventStreamForId(UniqueIdentifier $id): ?EventStream;

    public function appendToStream(UniqueIdentifier $id, DomainEvent ...$events): void;
}
