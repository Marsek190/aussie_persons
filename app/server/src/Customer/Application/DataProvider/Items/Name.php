<?php

namespace Customer\Application\DataProvider\Items;

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

    public function first(): string
    {
        return $this->first;
    }

    public function last(): string
    {
        return $this->last;
    }
}