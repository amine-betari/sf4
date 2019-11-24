<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 10/11/19
 * Time: 10:12
 */
// src/Controller/BlogController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;


class BlogController extends AbstractController
{
    /**
     * @Route("/blog/{page}",
     *     name="blog_list",
     *     condition="context.getMethod() in ['GET', 'HEAD']",
     *     requirements={"page"="\d+"}
     * )
     */
    public function list(int $page = 1)
    {
       return new Response('List Blog '.$page);
    }

    /**
     * @Route("/blog/{slug}",
     *     name="blog_show"
     * )
     */
    public function show(string $slug, SessionInterface $session)
    {
        dump( $session->get('fooa') );
        return new Response('Show Blog with '. $slug);
    }


    public function index(int $page)
    {
        return new Response("Index BLog ".$page);
    }

    public function index2(int $page)
    {
        // creates a CSS-response with a 200 status code
        $response = new Response('<style> ... </style>');
        $response->headers->set('Content-Type', 'text/jq');
        return $response;
        return new Response("Index 2 BLog ".$page);
    }

    public function new(SessionInterface $session)
    {
        // stores an attribute for reuse during a later user request
        $session->set('fooa', 'jocker123');

        // gets the attribute set by another controller in another request
        $foobar = $session->get('foobar');

        // uses a default value if the attribute doesn't exist
        $filters = $session->get('filters', []);
        dump($filters);

        return new Response("New BLog");
    }

    /**
     * @Route("/file",
     *     name="blog_file"
     * )
     */
    public function download()
    {
         // load the file from the filesystem
        $file = new File('/path/to/some_file.pdf');

        return $this->file($file);

        // rename the downloaded file
        return $this->file($file, 'custom_name.pdf');

        // display the file contents in the browser instead of downloading it
        return $this->file('invoice_3241.pdf', 'my_invoice.pdf', ResponseHeaderBag::DISPOSITION_INLINE);
    }


    /**
     * @Route("/share/{path}/{token}",
     *      name="share", requirements={
     *                      "path"=".+",
     *                      "token"=".+"
     *                   }
     * )
     */
    public function share($path, $token)
    {
        return new Response("path => ".$path. " token =>". $token);
    }


}