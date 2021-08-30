<?php

namespace Customer\Infrastructure\Repository\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="customer")
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="NONE")
     */
    public int $id;

    /**
     * @ORM\Column(name="first_name", type="string")
     */
    public string $firstName;

    /**
     * @ORM\Column(name="last_name", type="string")
     */
    public string $lastName;

    /**
     * @ORM\Column(type="string")
     */
    public string $country;

    /**
     * @ORM\Column(type="string")
     */
    public string $email;
}