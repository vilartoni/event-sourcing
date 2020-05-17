<?php

namespace Vilartoni\Ecommerce\Customer\Application;

use Vilartoni\Ecommerce\Customer\Domain\Customer;
use Vilartoni\Ecommerce\Customer\Domain\CustomerId;
use Vilartoni\Ecommerce\Customer\Domain\CustomerMail;
use Vilartoni\Ecommerce\Customer\Domain\CustomerRepository;
use Vilartoni\Shared\Application\ApplicationService;

final class CreateCustomer extends ApplicationService
{
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function __invoke(CreateCustomerCommand $command): void
    {
        $customerId = new CustomerId($command->id());
        $customerMail = new CustomerMail($command->mail());

        $customer = Customer::create($customerId, $customerMail);

        $this->customerRepository->save($customer);
    }
}
