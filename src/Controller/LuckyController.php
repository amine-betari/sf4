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
        dump($service2->sendMail());

        return new Response("VIVE MCO vs BERCHID ".$number );
    }

    public function add(EventDispatcherInterface $eventDispatcher)
    {
        /* ... */
        $event = new BasketProductAdded($product, $this->getUser());
        $eventDispatcher->dispatch(BasketProductAdded::NAME, $event);
    }


}