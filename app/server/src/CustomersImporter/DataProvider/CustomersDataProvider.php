<?php

namespace App\CustomersImporter\DataProvider;

use Exception;
use App\CustomersImporter\Handler\Command\Customer;
use App\CustomersImporter\Handler\Dto\Customer as CustomerDto;

interface CustomersDataProvider
{
    /**
     * @return CustomerDto[]
     * @throws Exception
     */
    public function collect(Customer $customer): array;
}