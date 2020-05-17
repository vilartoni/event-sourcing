<?php

namespace Vilartoni\Ecommerce\Customer\Domain;

use Vilartoni\Shared\Domain\Event\DomainEvent;

final class CustomerCreated extends DomainEvent
{
    private string $mail;

    public function __construct(string $id, string $mail)
    {
        $this->mail = $mail;

        parent::__construct($id);
    }

    public function eventName(): string
    {
        return 'vilartoni.ecommerce.customer.customer_created';
    }

    public function mail(): string
    {
        return $this->mail;
    }
}
