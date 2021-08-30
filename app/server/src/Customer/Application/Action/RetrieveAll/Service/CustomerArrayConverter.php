<?php

namespace Customer\Application\Action\RetrieveAll\Service;

use Customer\Domain\ValueObject\Customer;

class CustomerArrayConverter
{
    /**
     * @param Customer $customer
     * @return array
     */
    public function convert(Customer $customer): array
    {
        $name = $customer->name();

        return [
            'id' => $customer->id(),
            'full_name' => sprintf('%s %s', $name->first(), $name->last()),
        ];
    }
}