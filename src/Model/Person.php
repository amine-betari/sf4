<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 05/04/20
 * Time: 18:00
 */

namespace App\Model;

use Symfony\Component\Validator\Context\ExecutionContextInterface;


class Person
{
    private $age;
    private $name;
    private $sportsperson;
    private $createdAt;

    // Getters
    public function getName()
    {
        return $this->name;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    // Issers
    public function isSportsperson()
    {
        return $this->sportsperson;
    }

    // Setters
    public function setName($name)
    {
        $this->name = $name;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function setSportsperson($sportsperson)
    {
        $this->sportsperson = $sportsperson;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function validate(ExecutionContextInterface $context, $payload)
    {
        // somehow you have an array of "fake names"
        $fakeNames = array(/* ... */);

        // check if the name is actually a fake name
        if (in_array($this->getFirstName(), $fakeNames)) {
            $context->buildViolation('This name sounds totally fake!')
                ->atPath('firstName')
                ->addViolation();
        }
    }

}