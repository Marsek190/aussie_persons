<?php

namespace Src\Customers\Application\Repository;

use Exception;
use Src\Customers\Application\Dto\Customer;
use Src\Customers\Application\Exception\CustomerNotFoundException;

interface CustomerRepository
{
    /**
     * @param Customer[] $customers
     * @return void
     * @throws Exception
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