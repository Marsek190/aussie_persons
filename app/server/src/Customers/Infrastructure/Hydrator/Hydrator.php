<?php

namespace Src\Customers\Infrastructure\Hydrator;

interface Hydrator
{
    /**
     * @param string $className
     * @param array $data
     * @return object
     */
    public function hydrate(string $className, array $data): object;
}