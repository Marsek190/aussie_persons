<?php

namespace Customer\Infrastructure\Repository\Converter;

use Customer\Application\DataProvider\Items\Customer;
use Customer\Application\DataProvider\Items\Name;
use Customer\Infrastructure\Hydrator\Hydrator;
use Customer\Infrastructure\Repository\Entity\Customer as CustomerEntity;

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
            'id' => $customer->id(),
            'firstName' => $customer->name()->first(),
            'lastName' => $customer->name()->last(),
            'email' => $customer->email(),
            'country' => $customer->country(),
        ]);

        return $entity;
    }

    /**
     * @param CustomerEntity $entity
     * @return Customer
     */
    public function convertToValueObject(CustomerEntity $entity): Customer
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