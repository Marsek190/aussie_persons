<?php

namespace Src\Customers\Application\Dto;

class Location
{
    private string $city;
    private string $country;

    /**
     * @param string $city
     * @param string $country
     */
    public function __construct(string $city, string $country)
    {
        $this->city = $city;
        $this->country = $country;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }
}