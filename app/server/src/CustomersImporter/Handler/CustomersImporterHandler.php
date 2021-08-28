<?php

namespace App\CustomersImporter\Handler;

use Exception;
use App\CustomersImporter\Handler\Command\Customer;
use App\CustomersImporter\Repository\CustomerRepository;
use App\CustomersImporter\DataProvider\CustomersDataProvider;

class CustomersImporterHandler
{
    private CustomersDataProvider $customersDataProvider;

    private CustomerRepository $customerRepo;

    public function __construct(CustomersDataProvider $customersDataProvider, CustomerRepository $customerRepo)
    {
        $this->customersDataProvider = $customersDataProvider;
        $this->customerRepo = $customerRepo;
    }

    /**
     * @param Customer $customer
     * @return int
     * @throws Exception
     */
    public function handle(Customer $customer): int
    {
        $customers = $this->customersDataProvider->collect($customer);
        $this->customerRepo->save($customers);

        return count($customers);
    }
}