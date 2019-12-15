<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 30/11/19
 * Time: 23:57
 */

namespace App\Repository;


abstract class BaseDoctrineRepository
{
    protected $objectManager;
    protected $logger;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    // ...
}