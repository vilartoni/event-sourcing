<?php

namespace Vilartoni\Ecommerce\Customer\Domain;

use Vilartoni\Shared\Domain\Finder;
use Vilartoni\Shared\Domain\Identity\UniqueIdentifier;

final class CustomerFinder extends Finder
{
    protected function aggregateNotFoundException(UniqueIdentifier $id): CustomerNotFoundException
    {
        return new CustomerNotFoundException(
            sprintf('Customer with id \'%s\' not found', $id)
        );
    }
}
