<?php

namespace Vilartoni\Shared\Domain\Event;

use InvalidArgumentException;
use Vilartoni\Shared\Domain\Identity\UniqueIdentifier;

abstract class EventSourcingAggregateRoot
{
    private UniqueIdentifier $id;

    private array $newEvents = [];

    final public function __construct(DomainEvent ...$events)
    {
        foreach ($events as $event) {
            $this->mutate($event);
        }
    }

    public function id(): UniqueIdentifier
    {
        return $this->id;
    }

    protected function setId(UniqueIdentifier $id): void
    {
        $this->id = $id;
    }

    private function mutate(DomainEvent $event)
    {
        $eventHandler = $this->eventHandlerForEvent($event);

        if (!method_exists($this, $eventHandler)) {
            throw new InvalidArgumentException(
                sprintf('No event handler defined for %s in %s', get_class($event), get_class($this))
            );
        }

        call_user_func([$this, $eventHandler], $event);
    }

    private function eventHandlerForEvent(DomainEvent $event): string
    {
        return sprintf('on%s', get_class($event));
    }

    final protected function apply(DomainEvent $event): void
    {
        $this->mutate($event);
        $this->trackEvent($event);
    }

    private function trackEvent(DomainEvent $event): void
    {
        $this->newEvents[] = $event;
    }

    final public function newEvents(): array
    {
        $newEvents = $this->newEvents;
        $this->newEvents = [];

        return $newEvents;
    }
}
