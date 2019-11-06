<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 04/11/19
 * Time: 11:04
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Events\BasketProductAdded;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class LuckyController extends AbstractController
{
    public function number()
    {
        $number = random_int(0, 100);

        return $this->render('lucky/number.html.twig', [
            'number' => $number,
        ]);
    }

    /**
     * @Route("/mco")
     */
    public function mco()
    {
        $number = random_int(0, 100);

        return new Response("VIVE MCO vs BERCHID ".$number );
    }

    public function add(EventDispatcherInterface $eventDispatcher)
    {
        /* ... */
        $event = new BasketProductAdded($product, $this->getUser());
        $eventDispatcher->dispatch(BasketProductAdded::NAME, $event);
    }


}