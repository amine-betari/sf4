<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 05/11/19
 * Time: 18:09
 */

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Events\FooEvent;
use App\Events\BarEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        // Liste des évènements, méthodes et priorités
        return [
            'foo' => [
                ['doSomething', 10],
                ['doOtherThing', 0],
            ],
            'bar' => [
                ['doBarThing', -10]
            ],
        ];
    }

    public function doSomething(FooEvent $event) {}

    public function doOtherThing(FooEvent $event) {}

    public function doBarThing(BarEvent $event) {}
}