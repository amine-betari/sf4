<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 09/11/19
 * Time: 23:12
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;



/**
 * Objet représentant un panier d'achats.
 * @ORM\Entity()
 */
class Cart
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * Les produits sont liés à un panier
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", mappedBy="carts")
     */
    private $products;

    // ...

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }
}