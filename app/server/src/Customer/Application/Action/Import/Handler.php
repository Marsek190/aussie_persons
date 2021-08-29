<?php

namespace Customer\Application\Action\Import;

use Exception;
use Customer\Application\Repository\CustomerRepository;
use Customer\Application\Action\Import\Command\Customer;
use Customer\Application\DataProvider\CustomerDataProvider;

class Handler
{
    private CustomerDataProvider $customerDataProvider;
    private CustomerRepository $customerRepo;

    public function __construct(CustomerDataProvider $customerDataProvider, CustomerRepository $customerRepo)
    {
        $this->customerDataProvider = $customerDataProvider;
        $this->customerRepo = $customerRepo;
    }

    /**
     * @param Customer $command
     * @return int
     * @throws Exception
     */
    public function handle(Customer $command): int
    {
        $customers = $this->customerDataProvider->collect($command);
        $this->customerRepo->save($customers);

        return count($customers);
    }
}