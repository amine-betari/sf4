<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 30/11/19
 * Time: 23:57
 */

namespace App\Repository;

use App\Repository\BaseDoctrineRepository;

// ...
class DoctrineUserRepository extends BaseDoctrineRepository
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct($objectManager);
    }
}