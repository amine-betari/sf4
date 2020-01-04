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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

use App\Entity\Article;


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
        $response = new Response("Index Blog amine".$page);

        // cache for 3600 seconds
        $response->setSharedMaxAge(3600);

        // (optional) set a custom Cache-Control directive
        $response->headers->addCacheControlDirective('must-revalidate', true);
        dump($response);

      /*  // marks the Response stale
        $response->expire();

        // forces the response to return a proper 304 response with no content
        $response->setNotModified();

        // sets cache settings in one call
        $response->setCache(array(
            'etag'          => $etag,
            'last_modified' => $date,
            'max_age'       => 10,
            's_maxage'      => 10,
            'public'        => true,
            // 'private'    => true,
        ));*/

        $response->setVary('Accept-Encoding');

        // sets multiple vary headers
        $response->setVary(array('Accept-Encoding', 'User-Agent'));

        return $response;
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

    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        $num = random_int(100, 200);
        $response = $this->render('static/privacy.html.twig', [
            "num" => $num,
        ]);
        // sets the shared max age - which also marks the response as public
        $response->setSharedMaxAge(150);

        return $response;
    }

    /**
     * @Route("/home", name="home")
     */
    public function homepage(Request $request)
    {
        dump($request);
        dump($request->attributes->get("_route"));
        dump($request->getPathInfo());
        dump($request->getRequestUri());
        dump($request->getUri());
        die;
        $num = random_int(1000, 2000);
        $response = $this->render('static/homepage.html.twig', [
        //    "num" => $num,
        ]);
        $response->setEtag(md5($response->getContent()));
        $response->setPublic(); // make sure the response is public/cacheable
        // The isNotModified() method compares the If-None-Match header with the ETag response header.
        // If the two match, the method automatically sets the Response status code to 304.
        $response->isNotModified($request);

        return $response;
    }

    /**
     * @Route("/validation/{id<\d+>}", name="validation")
     */
    public function showvalidation(Article $article, Request $request)
    {
        $author = $article->getAuthor();
        $articleDate = new \DateTime($article->getUpdated()->format("Y/m/d"));
       // $authorDate = new \DateTime($author->getUpdatedAt());

        $date = $articleDate;

        $response = new Response("OLD OK");
        $response->setLastModified($date);
        // Set response as public. Otherwise it will be private by default.
        $response->setPublic();

        // The isNotModified() method compares the If-Modified-Since header with the Last-Modified response header.
        // If they are equivalent, the Response will be set to a 304 status code.
        if ($response->isNotModified($request)) {
            $response->setStatusCode(Response::HTTP_NOT_MODIFIED);

            return $response;
        }

        // ... do more work to populate the response with the full content
        $response = new Response("NEW OK");
        return $response;
    }


}