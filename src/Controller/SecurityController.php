<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 23/05/20
 * Time: 00:37
 */

namespace App\Controller;

use App\Twig\AppRuntime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{

    /**
     * @Route("/security/chp1", name="chp1")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function security1(Request $request)
    {
        $article = new \App\Entity\Article();
        // usually you'll want to make sure the user is authenticated first
       // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', $article);
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
       // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User1 $user */
        $user = $this->getUser();
        dump($user);
        die;

        // Call whatever methods you've added to your User class
        // For example, if you added a getFirstName() method, you can use that.
        return new Response('Well hi there '.$user->getFirstName());

    }

    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/admin")
     */
    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }


    /**
     * @Route("/api", name="api")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function api(Request $request)
    {
        $article = new \App\Entity\Article();
        $this->denyAccessUnlessGranted('ROLE_API', $article);

        die;
    }
}