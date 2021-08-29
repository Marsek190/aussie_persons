<?php

namespace Customer\Application\Action\Import\Command;

class Customer
{
    private int $quantity;

    /**
     * @param int $quantity
     */
    public function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }
}