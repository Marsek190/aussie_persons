<?php

namespace Src\Customers\Infrastructure\Hydrator;

interface Hydrator
{
    public function hydrate(string $className, array $data): object;
}