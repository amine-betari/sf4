<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 09/11/19
 * Time: 22:29
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Objet qui définit un client
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * Un client a potentiellement plusieurs adresses
     * @ORM\OneToMany(targetEntity="App\Entity\Address", mappedBy="customer")
     */
    private $addresses;

    // ...

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }
}

/**
 * Objet qui définit une adresse
 */
class Address
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * Les adresses sont liées à un client
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="addresses")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;
}