<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 18/04/20
 * Time: 17:55
 */

namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Objet qui définit un tag
 * @ORM\Entity()
 */
class Tag
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Product")
     * @ORM\JoinTable(name="article_tags")
     */
    private $products;


    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }



}