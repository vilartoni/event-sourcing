<?php

namespace Vilartoni\Ecommerce\Customer\Domain;

use Vilartoni\Shared\Domain\EventSourcingAggregateRoot;

final class Customer extends EventSourcingAggregateRoot
{
    private CustomerMail $mail;

    public static function create(CustomerId $id, CustomerMail $mail): self
    {
        $customer = new self();

        $customer->apply(
            new CustomerCreated($id->value(), $mail->value())
        );

        return $customer;
    }

    private function setMail(CustomerMail $mail): void
    {
        $this->mail = $mail;
    }

    public function mail(): CustomerMail
    {
        return $this->mail;
    }

    public function onCustomerCreated(CustomerCreated $event): void
    {
        $this->setId(new CustomerId($event->aggregateId()));
        $this->setMail(new CustomerMail($event->mail()));
    }
}
