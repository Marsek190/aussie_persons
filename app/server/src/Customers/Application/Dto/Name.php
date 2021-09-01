<?php

namespace Src\Customers\Application\Dto;

class Name
{
    private string $first;
    private string $last;

    /**
     * @param string $first
     * @param string $last
     */
    public function __construct(string $first, string $last)
    {
        $this->first = $first;
        $this->last = $last;
    }

    public function getFirst(): string
    {
        return $this->first;
    }

    public function getLast(): string
    {
        return $this->last;
    }
}