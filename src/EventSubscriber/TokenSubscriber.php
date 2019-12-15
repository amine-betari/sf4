<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 26/11/19
 * Time: 10:40
 */

namespace App\EventSubscriber;

use App\Controller\TokenAuthenticatedController;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class TokenSubscriber implements EventSubscriberInterface
{
    private $tokens;

    public function __construct(ContainerBagInterface $tokens)
    {
        $this->tokens = $tokens;
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => 'onKernelController',
            KernelEvents::RESPONSE => 'onKernelResponse',
        );
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        /*
         * $controller passed can be either a class or a Closure.
         * This is not usual in Symfony but it may happen.
         * If it is a class, it comes in array format
         */
        if (!is_array($controller)) {
            return;
        }
       // dump($controller);

        if ($controller[0] instanceof TokenAuthenticatedController) {
            dump($event->getRequest());

            $token = $event->getRequest()->query->get('token');

            if (!in_array($token, $this->tokens->get('tokens'))) {
                throw new AccessDeniedHttpException('This action needs a valid token!');
            }

            $event->getRequest()->attributes->set('auth_token', $token);
        }
    }


    public function onKernelResponse(FilterResponseEvent $event)
    {
        // check to see if onKernelController marked this as a token "auth'ed" request
        if (!$token = $event->getRequest()->attributes->get('auth_token')) {
            return;
        }

        $response = $event->getResponse();

        // create a hash and set it as a response header
        dump($response->headers->all());
        $hash = sha1($response->getContent().$token);
        $response->headers->set('X-CONTENT-HASH', $hash);
        dump($response->headers->all());

        $event->setResponse($response);
    }


}