<?php

namespace Vilartoni\Ecommerce\Customer\Application;

use Vilartoni\Shared\Application\Command;

final class CreateCustomerCommand implements Command
{
    private string $id;

    private string $mail;

    public function __construct(string $id, string $mail)
    {
        $this->id = $id;
        $this->mail = $mail;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function mail(): string
    {
        return $this->mail;
    }
}
