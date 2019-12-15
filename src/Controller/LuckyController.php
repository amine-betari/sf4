<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 04/11/19
 * Time: 11:04
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

use Psr\Log\LoggerInterface;
use App\Events\BasketProductAdded;
use App\Services\MailLogger;
use App\Services\MessageGenerator;
use App\Services\TwitterClient;


class LuckyController extends AbstractController
{
    private $mailLogger;

    private $adminEmail;

    public function __construct(MailLogger $mailLogger, string $adminEmail)
    {
        $this->mailLogger = $mailLogger;
        $this->adminEmail = $adminEmail;
    }

    /**
     * @Route("/controller")
     */
    public function index()
    {
        if ( 1 < 2 ) {
           //  throw $this->createNotFoundException('The product does not exist');
           //  throw new NotFoundHttpException("NOT FOUND FOUND");
            throw new \Exception("NOT FOUND FOUND");
        }
        return $this->redirectToRoute('mco', [], 301);
    }


    public function number(LoggerInterface $logger)
    {
        dump($this->mailLogger);
        dump($this->adminEmail);
        dump($logger);

        // Test Maubeuge
        $now = \DateTime::createFromFormat('U', time());
        $now->setTimezone(new \DateTimeZone('UTC'));
        dump($now->format('D, d M Y H:i:s').' GMT');

        $logger->info("we are logging");

        $number = random_int(0, 100);

        return $this->render('lucky/number.html.twig', [
            'number' => $number,
        ]);
    }

    /**
     * @Route("/mco", name="mco")
     */
    public function mco()
    {
        $number = random_int(0, 100);

        // there IS a public "router" service in the container
        $router = $this->container->get('router');

        // this will not Work: MailLogger is a private service
        // $service1 = $this->container->get(MailLogger::class);

        $service2 = $this->mailLogger;
       // dump($service2->sendMail());
        $number = random_int(1, 11);

        $response = new Response("VIVE MCO vs BERCHID  ".$number);

        /*$date = new \DateTime();
        $date->modify('+60 seconds');
        $response->setExpires($date);*/

        $response->setSharedMaxAge(60);


        return $response;
    }

    public function add(EventDispatcherInterface $eventDispatcher)
    {
        /* ... */
        $event = new BasketProductAdded($product, $this->getUser());
        $eventDispatcher->dispatch(BasketProductAdded::NAME, $event);
    }

    /**
     * @Route("/new", name="new")
     */
    public function new(MessageGenerator $messageGenerator)
    {
        // thanks to the type-hint, the container will instantiate a
        // new MessageGenerator and pass it to you!
        // ...
        // dump($this->container->get('App\Services\MessageGenerator'));
        dump($this->get('app.message'));
        $message = $messageGenerator->getHappyMessage();
        $this->addFlash('success', $message);
        // ...
        return new Response('NEW PATHH');
    }

    /**
     * @Route("/tweet")
     */
    public function tweet(TwitterClient $twitterClient)
    {
        // fetch $user, $key, $status from the POST'ed data

    //    $twitterClient = $this->container->get(TwitterClient::class);
        dump($twitterClient);
        die;
        $twitterClient->tweet($user, $key, $status);

        // ...
    }


}