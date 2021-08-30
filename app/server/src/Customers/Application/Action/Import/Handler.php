<?php

namespace Src\Customers\Application\Action\Import;

use Exception;
use Src\Customers\Application\Repository\CustomerRepository;
use Src\Customers\Application\Action\Import\Command\Customer as CustomerCommand;
use Src\Customers\Application\DataProvider\CustomerDataProvider;

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
     * @param CustomerCommand $command
     * @return int
     * @throws Exception
     */
    public function handle(CustomerCommand $command): int
    {
        $customers = $this->customerDataProvider->collect($command);
        $this->customerRepo->save($customers);

        return count($customers);
    }
}