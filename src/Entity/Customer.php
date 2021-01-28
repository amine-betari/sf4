<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\GroupSequenceProviderInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompanyRepository")
 * @Assert\GroupSequenceProvider
 */
class Customer implements GroupSequenceProviderInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $country;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }



    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipcode(): ?int
    {
        return $this->zipcode;
    }

    public function setZipcode(?int $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }


    /**
     * @Assert\NotBlank(groups={"foo"}, message = "Groupe Foo attribute foo")
     */
    public $foo;

    /**
     * @Assert\NotBlank(groups={"foo"}, message = "Groupe Foo attribute foo2")
     */
    public $foo2;

    /**
     * @Assert\NotBlank(groups={"Product"}, message = "Groupe Product attribute bar")
     */
    public $bar;

    /**
     * @Assert\NotBlank(groups={"Amine"}, message = "Groupe nothing attribute bar2")
     */
    public $bar2;


    /**
     * Basic Usage
     * @Assert\NotBlank(groups={"Range"}, message = "Groupe Age attribute age")
     * @Assert\Range(
     *      min = 18,
     *      minMessage = "You must be at least {{ limit }} years to pass this formulaire",
     *      invalidMessage = "Belfrakhi 3nadedk fo9 18 ?",
     *      groups={"Range"}
     * )
     */
    public $age;

    /**
     * Date Ranges ===> This constraint can be used to compare DateTime objects against date ranges. The minimum and maximum date of the range should be given as any date string accepted by the DateTime constructor.
     * @Assert\Range(
     *      min = "now",
     *      max = "+5 hours",
     *      groups={"Range"}
     * )
     */
    public $deliveryDate;

    /**
     * @Assert\DateTime(groups={"Range"})
     */
    public $startDate;

    /**
     * @Assert\DateTime(groups={"Range"})
     * @Assert\Expression(
     *     "this.endDate > this.startDate",
     *      message="Date start doit etre inférieure que la date de fin",
     *      groups={"Range"}
     * )
     * @Assert\GreaterThan(propertyPath="startDate")
     */
    public $endDate;




    /**
     * /^\w+/",
     * @Assert\Regex(
     *     "/\d/",
     *     match=false,
     *     message="Your name cannot contain a number",
     *     groups={"Regex"}
     * )
     */
    public $description;


    private $category;

    /**
     * @Assert\Expression(
     *     "this.getCategory() in ['php', 'symfony'] or value == false",
     *      message="If this is a tech post, the category should be either php or symfony!",
     *      groups={"Regex"}
     * )
     */
    private $isTechnicalPost;

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getIsTechnicalPost()
    {
        return $this->isTechnicalPost;
    }

    /**
     * @param mixed $isTechnicalPost
     */
    public function setIsTechnicalPost($isTechnicalPost): void
    {
        $this->isTechnicalPost = $isTechnicalPost;
    }





    public function getGroupSequence(): array
    {
        return [['foo', 'Product'], ['Range', 'Regex']];
    }
}
