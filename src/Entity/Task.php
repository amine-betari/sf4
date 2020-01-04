<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 17/12/19
 * Time: 08:44
 */

namespace App\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class Task
{
    protected $task;
    protected $dueDate;

    public function getTask()
    {
        return $this->task;
    }

    public function setTask($task)
    {
        $this->task = $task;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTime $dueDate = null)
    {
        $this->dueDate = $dueDate;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('task', new NotBlank());

        $metadata->addPropertyConstraint('dueDate', new NotBlank());
        $metadata->addPropertyConstraint(
            'dueDate',
            new Type(\DateTime::class)
        );
    }

    /*public function __get($name)
    {
        // TODO: Implement __get() method.
        dump("nour");
    }*/
}