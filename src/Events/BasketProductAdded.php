<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 06/11/19
 * Time: 10:00
 */

namespace App\Events;

use Symfony\Component\EventDispatcher\Event;
use App\Entity\Product;
use App\Entity\Customer;

class BasketProductAdded extends Event
{
    const NAME = 'basket.product_added';

    private $product;
    private $customer;

    public function __construct(Product $product, Customer $customer)
    {
        $this->product = $product;
        $this->customer = $customer;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getCustomer()
    {
        return $this->customer;
    }
}