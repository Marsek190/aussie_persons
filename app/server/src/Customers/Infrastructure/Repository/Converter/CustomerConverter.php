<?php

namespace Src\Customers\Infrastructure\Repository\Converter;

use Src\Customers\Application\Dto\Customer;
use Src\Customers\Application\Dto\Location;
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
            'city' => $customer->getLocation()->getCity(),
            'country' => $customer->getLocation()->getCountry(),
            'phone' => $customer->getPhone(),
            'username' => $customer->getUsername(),
            'gender' => $customer->getGender(),
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
        $location = new Location($entity->city, $entity->country);

        return new Customer(
            $entity->id,
            $name,
            $location,
            $entity->email,
            $entity->username,
            $entity->phone,
            $entity->gender
        );
    }

    /**
     * @param CustomerEntity $entity
     * @param Customer $customer
     * @return CustomerEntity
     */
    public function convertToExistsEntity(CustomerEntity $entity, Customer $customer): CustomerEntity
    {
        $entity->id = $customer->getId();
        $entity->firstName = $customer->getName()->getFirst();
        $entity->lastName = $customer->getName()->getLast();
        $entity->email = $customer->getEmail();
        $entity->gender = $customer->getGender();
        $entity->phone = $customer->getPhone();
        $entity->username = $customer->getUsername();
        $entity->city = $customer->getLocation()->getCity();
        $entity->country = $customer->getLocation()->getCountry();

        return $entity;
    }
}