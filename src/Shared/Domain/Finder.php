<?php

namespace Vilartoni\Shared\Domain;

use Vilartoni\Shared\Domain\Event\EventSourcingAggregateRoot;
use Vilartoni\Shared\Domain\Identity\UniqueIdentifier;

abstract class Finder
{
    private Repository $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function find(UniqueIdentifier $id): ?EventSourcingAggregateRoot
    {
        $aggregate = $this->repository->search($id);

        if (is_null($aggregate)) {
            throw $this->aggregateNotFoundException($id);
        }

        return $aggregate;
    }

    abstract protected function aggregateNotFoundException(UniqueIdentifier $id): AggregateNotFoundException;
}
