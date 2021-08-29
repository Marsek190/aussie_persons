<?php

namespace Customer\Infrastructure\Repository\Converter;

use Customer\Domain\ValueObject\Customer;
use Customer\Domain\ValueObject\Name;
use Customer\Infrastructure\Hydrator\Hydrator;
use Customer\Infrastructure\Repository\Entity\Customer as CustomerEntity;

class CustomerConverter
{
    private Hydrator $hydrator;

    public function __construct(Hydrator $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    public function convertToEntity(Customer $customer): CustomerEntity
    {
        /** @var CustomerEntity $entity */
        $entity = $this->hydrator->hydrate(CustomerEntity::class, [
            'id' => $customer->id(),
            'firstName' => $customer->name()->first(),
            'lastName' => $customer->name()->last(),
        ]);

        return $entity;
    }

    public function convertToValueObject(CustomerEntity $entity): Customer
    {
        /** @var Name $name */
        $name = $this->hydrator->hydrate(Name::class, [
            'first' => $entity->firstName,
            'last' => $entity->lastName,
        ]);

        /** @var Customer $customer */
        $customer = $this->hydrator->hydrate(Customer::class, [
            'id' => $entity->id,
            'name' => $name,
        ]);

        return $customer;
    }
}