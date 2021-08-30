<?php

namespace Src\Customers\Application\Dto;

class Customer
{
    private int $id;
    private Name $name;
    private string $email;
    private string $country;

    /**
     * @param int $id
     * @param Name $name
     * @param string $email
     * @param string $country
     */
    public function __construct(int $id, Name $name, string $email, string $country)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->country = $country;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCountry(): string
    {
        return $this->country;
    }
}