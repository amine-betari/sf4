<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 26/11/19
 * Time: 10:28
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class FooController extends Controller implements TokenAuthenticatedController
{

    // An action that needs authentication

    /**
     * @Route("/api/foo",
     *     name="api_foo"
     * )
     */
    public function bar()
    {
        return new Response("FOO OK");
    }

}