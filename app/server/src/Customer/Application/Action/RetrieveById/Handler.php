<?php

namespace Customer\Application\Action\RetrieveById;

use Customer\Application\Exception\CustomerNotFoundException;
use Customer\Application\Repository\CustomerRepository;
use Customer\Application\Action\RetrieveById\Service\CustomerArrayConverter;
use Customer\Application\Action\RetrieveById\Command\Customer as CustomerCommand;

class Handler
{
    private CustomerRepository $customerRepo;
    private CustomerArrayConverter $converter;

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