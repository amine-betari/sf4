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

use Doctrine\Common\Collections\ArrayCollection;

class TagModelTransformer implements DataTransformerInterface
{
    private $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function transform($value)
    {
        // $tags = $this->tagRepository->findAll();

        $tags = new ArrayCollection();
        $tags->add(new Tag('TAG 1'));
        $tags->add(new Tag('TAG 2'));
        $tags->add(new Tag('TAG 3'));

        $tagArray = $tags->toArray();
        return $tagArray;
        // Convert ArrayCollextion to simple array()
    }

    public function reverseTransform($value)
    {
        // TODO: Implement reverseTransform() method.
        // inverse
        $tag1 = ['TAG1'];
        $tag2 = ['TAG2'];
        $tag3 = ['TAG3'];

        $tags = new ArrayCollection($value);
        // $tags->slice($ta);
    }


}