<?php

namespace Src\Customers\Application\DataProvider;

use Exception;
use Src\Customers\Application\Dto\Customer;
use Src\Customers\Application\Action\Import\Command\Customer as CustomerCommand;

interface CustomerDataProvider
{
    /**
     * @param CustomerCommand $command
     * @return Customer[]
     * @throws Exception
     */
    public function collect(CustomerCommand $command): array;
}