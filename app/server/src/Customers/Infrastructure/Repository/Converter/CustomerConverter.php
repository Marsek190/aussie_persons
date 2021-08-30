<?php

namespace Src\Customers\Infrastructure\Repository\Converter;

use Src\Customers\Application\Dto\Customer;
use Src\Customers\Application\Dto\Name;
use Src\Customers\Infrastructure\Hydrator\Hydrator;
use Src\Customers\Infrastructure\Repository\Entity\Customer as CustomerEntity;

class CustomerConverter
{
    private Hydrator $hydrator;

    public function __construct(Hydrator $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * @param Customer $customer
     * @return CustomerEntity
     */
    public function convertToEntity(Customer $customer): CustomerEntity
    {
        /** @var CustomerEntity $entity */
        $entity = $this->hydrator->hydrate(CustomerEntity::class, [
            'id' => $customer->getId(),
            'firstName' => $customer->getName()->getFirst(),
            'lastName' => $customer->getName()->getLast(),
            'email' => $customer->getEmail(),
            'country' => $customer->getCountry(),
        ]);

        return $entity;
    }

    /**
     * @param CustomerEntity $entity
     * @return Customer
     */
    public function convertToDto(CustomerEntity $entity): Customer
    {
        $name = new Name($entity->firstName, $entity->lastName);

        return new Customer(
            $entity->id,
            $name,
            $entity->email,
            $entity->country
        );
    }
}