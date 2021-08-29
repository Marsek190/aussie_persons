<?php

namespace Customer\Application\DataProvider;

use Exception;
use Customer\Domain\ValueObject\Customer;
use Customer\Application\Action\Import\Command\Customer as CustomerCommand;

interface CustomerDataProvider
{
    /**
     * @param CustomerCommand $command
     * @return Customer[]
     * @throws Exception
     */
    public function collect(CustomerCommand $command): array;
}