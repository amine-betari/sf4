<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 21/06/20
 * Time: 18:59
 */
// src/EventListener/SwitchUserSubscriber.php
namespace App\EventSubscriber;

use Symfony\Component\Security\Http\Event\SwitchUserEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\SecurityEvents;

class SwitchUserSubscriber implements EventSubscriberInterface
{
    public function onSwitchUser(SwitchUserEvent $event)
    {
        $event->getRequest()->getSession()->set(
            '_locale',
            // assuming your User has some getLocale() method
            $event->getTargetUser()->getLocale()
        );
    }

    public static function getSubscribedEvents()
    {
        return array(
            // constant for security.switch_user
            SecurityEvents::SWITCH_USER => 'onSwitchUser',
        );
    }
}