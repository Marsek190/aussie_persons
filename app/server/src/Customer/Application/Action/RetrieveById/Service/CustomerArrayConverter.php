<?php

namespace Customer\Application\Action\RetrieveById\Service;

use Customer\Application\DataProvider\Items\Customer;

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
            'email' => $customer->email(),
            'country' => $customer->country(),
        ];
    }
}