<?php

namespace Src\Customers\Infrastructure\Repository\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="customer",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="search_idx", columns={"email"})
 *     }
 * )
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public int $id;

    /**
     * @ORM\Column(name="first_name", type="string", length=30)
     */
    public string $firstName;

    /**
     * @ORM\Column(name="last_name", type="string", length=30)
     */
    public string $lastName;

    /**
     * @ORM\Column(type="string", length=50)
     */
    public string $city;

    /**
     * @ORM\Column(type="string", length=15)
     */
    public string $country;

    /**
     * @ORM\Column(type="string", length=50)
     */
    public string $email;

    /**
     * @ORM\Column(type="string", length=20)
     */
    public string $phone;

    /**
     * @ORM\Column(type="string", length=50)
     */
    public string $username;

    /**
     * @ORM\Column(type="string", length=50)
     */
    public string $gender;
}