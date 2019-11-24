<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 09/11/19
 * Time: 22:19
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Objet représentant une commande Client
 * @ORM\Entity()
 */
class Command
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * Il y a un seul panier possible par commande
     * @ORM\OneToOne(targetEntity="App\Entity\Cart")
     * @ORM\JoinColumn(name="cart_id", referencedColumnName="id")
     */
    private $cart;

}

