<?php

namespace Src\Customers\Application\Dto;

class Customer
{
    private Name $name;
    private Location $location;
    private string $email;
    private string $username;
    private string $gender;
    private string $phone;

    /**
     * @param Name $name
     * @param Location $location
     * @param string $email
     * @param string $username
     * @param string $gender
     * @param string $phone
     */
    public function __construct(
        Name $name,
        Location $location,
        string $email,
        string $username,
        string $gender,
        string $phone
    ) {
        $this->name = $name;
        $this->location = $location;
        $this->email = $email;
        $this->username = $username;
        $this->gender = $gender;
        $this->phone = $phone;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getLocation(): Location
    {
        return $this->location;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}