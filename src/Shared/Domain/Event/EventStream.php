<?php

namespace Vilartoni\Shared\Domain\Event;

final class EventStream
{
    private array $events;

    /**
     * @return array
     */
    public function events(): array
    {
        return $this->events;
    }
}
