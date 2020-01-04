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
final class Cart
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

    /**
     * @param $a
     * @param $b
     * @return mixed
     *
     * @deprecated
     */
    public function add($a, $b)
    {

       // die;
        @trigger_error(sprintf('The %s method is deprecated si,ce version 2.8 and will be removed in version 3.0'));

        return Cart::sum($a, $b);
    }

    public function sum($a, $b)
    {
        return $a+$b;

    }
}