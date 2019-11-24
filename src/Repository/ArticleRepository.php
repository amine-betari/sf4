<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 10/11/19
 * Time: 00:43
 */

namespace App\Repository;


use App\Entity\Article;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function findLastArticles()
    {
        return $this->findBy([], ['publicationDate' => 'DESC']);
    }
}

