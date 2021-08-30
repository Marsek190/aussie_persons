<?php

namespace Src\Customers\Application\Action\RetrieveAll;

use Src\Customers\Application\Action\RetrieveAll\Service\CustomerArrayConverter;
use Src\Customers\Application\Repository\CustomerRepository;

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
     * @return array
     */
    public function handle(): array
    {
        $customers = $this->customerRepo->findAll();

        $result = [];
        foreach ($customers as $customer) {
            $result[] = $this->converter->convert($customer);
        }

        return $result;
    }
}