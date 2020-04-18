<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 18/04/20
 * Time: 18:21
 */

namespace App\Form\DataTransformer;

use App\Entity\Article;
use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use App\Repository\TagRepository;

class TagViewTransformer implements DataTransformerInterface
{
    private $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function transform($value)
    {
        if (null === $value) {
            return '';
        }
        // transform the array to a string
        // transform the original value into a format that'll be used to render the field
        return implode(', ', $value);
    }

    public function reverseTransform($value)
    {
        if (null === $value || '' === $value) {
            return [];
        }
        // transform the string back to an array
        // it transforms the submitted value back into the format you will use
        return explode(', ', $value);
    }


}