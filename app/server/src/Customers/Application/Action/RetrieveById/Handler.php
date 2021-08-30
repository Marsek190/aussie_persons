<?php

namespace Src\Customers\Application\Action\RetrieveById;

use Src\Customers\Application\Exception\CustomerNotFoundException;
use Src\Customers\Application\Repository\CustomerRepository;
use Src\Customers\Application\Action\RetrieveById\Service\CustomerArrayConverter;
use Src\Customers\Application\Action\RetrieveById\Command\Customer as CustomerCommand;

class Handler
{
    private CustomerRepository $customerRepo;
    private CustomerArrayConverter $converter;

    /**
     * @param CustomerRepository $customerRepo
     * @param CustomerArrayConverter $converter
     */
    public function __construct(CustomerRepository $customerRepo, CustomerArrayConverter $converter)
    {
        $this->customerRepo = $customerRepo;
        $this->converter = $converter;
    }

    /**
     * @param CustomerCommand $command
     * @return array
     * @throws CustomerNotFoundException
     */
    public function handle(CustomerCommand $command): array
    {
        $customer = $this->customerRepo->findById($command->getId());

        return $this->converter->convert($customer);
    }
}