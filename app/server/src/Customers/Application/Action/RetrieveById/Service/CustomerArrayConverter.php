<?php

namespace Src\Customers\Application\Action\RetrieveById\Service;

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
        $location = $customer->getLocation();

        return [
            'id' => $customer->getId(),
            'fullName' => sprintf('%s %s', $name->getFirst(), $name->getLast()),
            'email' => $customer->getEmail(),
            'country' => $location->getCountry(),
            'username' => $customer->getUsername(),
            'gender' => $customer->getGender(),
            'city' => $location->getCity(),
            'phone' => $customer->getPhone(),
        ];
    }
}