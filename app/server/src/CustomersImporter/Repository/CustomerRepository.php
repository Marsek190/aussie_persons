<?php

namespace App\CustomersImporter\Repository;

use App\CustomersImporter\Handler\Dto\Customer as CustomerDto;
use App\CustomersImporter\Repository\Entity\Customer as CustomerEntity;

class CustomerRepository
{
    public function __construct()
    {
    }

    /**
     * @param CustomerDto[] $customers
     * @return void
     */
    public function save(array $customers)
    {
        $entities = [];
        foreach ($customers as $customer) {
            $entities[] = new CustomerEntity();

        }


    }
}