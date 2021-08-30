<?php

namespace Customer\Application\Repository;

use Customer\Application\DataProvider\Items\Customer;
use Customer\Application\Exception\CustomerNotFoundException;

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
     * @throws CustomerNotFoundException
     */
    public function findById(int $id): Customer;
}