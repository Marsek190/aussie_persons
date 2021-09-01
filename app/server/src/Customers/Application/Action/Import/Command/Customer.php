<?php declare(strict_types=1);

namespace Src\Customers\Application\Action\Import\Command;

use Symfony\Component\Validator\Constraints as Assert;

class Customer
{
    /**
     * @Assert\LessThanOrEqual(500, message="...")
     * @Assert\GreaterThanOrEqual(100, message="...")
     */
    private int $limit;

    /**
     * @param int $limit
     */
    public function __construct(int $limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }
}