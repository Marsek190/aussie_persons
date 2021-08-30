<?php

namespace Src\Customers\Application\Action\RetrieveAll\Service;

use Src\Customers\Application\Dto\Customer;

class CustomerArrayConverter
{
    /**
     * @param Customer $customer
     * @return array
     */
    public function convert(Customer $customer): array
    {
        $name = $customer->getName();

        return [
            'id' => $customer->getId(),
            'full_name' => sprintf('%s %s', $name->getFirst(), $name->getLast()),
        ];
    }
}