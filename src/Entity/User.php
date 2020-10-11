<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 04/04/20
 * Time: 20:01
 */

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;


class User implements UserInterface
{
    /**
     * @Assert\Email(groups={"registration"})
     */
    private $email;

    /**
     * @Assert\NotBlank(groups={"registration"})
     * @Assert\Length(min=7, groups={"registration"})
     */
    private $password;

    /**
     * @Assert\Length(min=2)
     */
    private $city;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @see UserInterface
     *
     * @return string
     *
     */
    public function getUsername()
    {
        return $this->username;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }


    /**
     * @see UserInterface
     */
    public function getSalt()
    {
    }


    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
    }

}