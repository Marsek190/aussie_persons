<?php

namespace Customer\Application\Action\Import\Dto\Customer;

class Customer
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $country;

    /**
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $country
     */
    public function __construct(int $id, string $firstName, string $lastName, string $email, string $country)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->country = $country;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
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