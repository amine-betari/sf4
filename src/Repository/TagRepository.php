<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 18/04/20
 * Time: 18:02
 */

namespace App\Repository;


use App\Entity\Tag;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class TagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag::class);
    }

    public function persistAndFlush(Tag $tag)
    {
        $em = $this->getEntityManager();
        $em->persist($tag);
        $em->flush();

    }

}