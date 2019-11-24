<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 05/11/19
 * Time: 18:09
 */

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        // Liste des évènements, méthodes et priorités
        return array(
            KernelEvents::EXCEPTION => array(
                array('processException', 12),
                array('logException', 11),
                array('notifyException', 1),
            )
        );
    }

    public function processException(GetResponseForExceptionEvent $event)
    {
        // ...
        dump('1');
        dump($event);
        $event->stopPropagation();
    }

    public function logException(GetResponseForExceptionEvent $event)
    {
        // ...
        dump('2');
        dump($event);
    }

    public function notifyException(GetResponseForExceptionEvent $event)
    {
        // ...
        dump('3');
        dump($event);
    }
}