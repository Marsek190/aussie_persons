<?php

namespace Customer\Application\Repository;

use Customer\Domain\ValueObject\Customer;

interface CustomerRepository
{
    /**
     * @param Customer[] $customers
     * @return void
     */
    public function save(array $customers): void;

    /** @return Customer[] */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Customer
     */
    public function findById(int $id): Customer;
}