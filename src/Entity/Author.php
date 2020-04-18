<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 29/03/20
 * Time: 18:24
 */

namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints\ContainsAlphanumeric;

use Symfony\Component\Validator\Mapping\ClassMetadata;



class Author
{
    /**
     * @Assert\NotBlank()
     */
    public $name;

    /**
     * @Assert\Choice(
     *     choices = { "fiction", "non-fiction" },
     *     message = "Choose a valid genre.  ops"
     * )
     */
    public $genre;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=3, groups={"registration"})
     */
    private $firstName;

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }


    /**
     * @Assert\IsTrue(message="The password cannot match your first name")
     */
    public function isPasswordSafe()
    {
        return $this->getFirstName() !== "BETARIs";

    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
     //   $metadata->addPropertyConstraint('name', new NotBlank());
        $metadata->addPropertyConstraint('name', new ContainsAlphanumeric());
    }



}