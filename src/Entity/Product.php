<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 09/11/19
 * Time: 22:52
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Objet qui définit un produit
 * @ORM\Entity()
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * Un produit peut être mis dans plusieurs paniers
     * @ORM\ManyToMany(targetEntity="App\Entity\Cart", inversedBy="products")
     * @ORM\JoinTable(name="products_carts")
     */
    private $carts;


    public function __construct()
    {
        $this->carts = new ArrayCollection();
    }
}
