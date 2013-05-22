<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="app_contact")
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="string")
     */
    protected $firstName;

    public function setFirstName($argument1)
    {
        $this->firstName = $argument1;
        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }


    /**
     * @ORM\Column(type="string")
     */
    protected $lastName;

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

}