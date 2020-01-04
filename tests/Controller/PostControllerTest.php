<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 14/12/19
 * Time: 17:11
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity\Cart;

class PostControllerTest extends WebTestCase
{

    public function testShowPost()
    {
        $client = static::createClient();

        // Crawler is object which can be used to select elements in the Response
        // The Crawler only works when the response is an XML or an HTML
        $crawler = $client->request('GET', '/home');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains("Static", $client->getResponse()->getContent());
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Static content HomePage")')->count()
        );

        // CSS selector
        $link = $crawler
            ->filter('a:contains("Abetari.com")') // find all links with the text "Greet"
            ->eq(1) // select the second link in the list
            ->link()
        ;

        // and click it
        $crawler = $client->click($link);
    }

    /**
     * @dataProvider provideUrls
     */
    public function testPageIsSuccessful($url)
    {
        /*
         request(
                $method,
                $uri,
                array $parameters = array(),
                array $files = array(),
                array $server = array(),
                $content = null,
                $changeHistory = true
                )
        */
        $client = self::createClient();
        $client->request('GET', $url);
//        dump($client->getResponse()->isFresh());
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function provideUrls()
    {
        /*return array(
            array('/home'),
            array('/blog'),
            array('/mco'),
            // ...
        );*/

        yield ['/validation/1'];
        yield ['/home'];
        yield ['/mco'];
        yield ['/blog/12'];
        yield ['/form/new'];
    }

    public function testFormNew()
    {

        $photo = new UploadedFile(
            '/public/uploads/brochures/billet_to_paris.jpg',
            'billet_to_paris.pdf',
            'application/pdf',
            123
        );
        $client = self::createClient();
        $crawler = $client->request(
            'POST',
            '/form/new'
        );
        $this->assertTrue($client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Créer')->form();
        $crawler = $client->submit($form);

        // Accessing the Container
        $container = $client->getContainer();

        // Accessing the Profiler Data
        $client->enableProfiler();
        $crawler = $client->request('GET', '/profiler');
        $profile = $client->getProfile();


        // Redirect
        // $crawler = $client->followRedirect();

        // Exception
        $client->catchExceptions(false);

       /* $client = static::createClient(array(
            'environment' => 'my_test_env',
            'debug'       => false,
        )); */
    }

    public function testSum()
    {
        $cart = new Cart();
        $this->assertIsObject($cart);

        $this->assertEquals(10, $cart->add(5,5));
        $this->assertEquals(10, $cart->sum(5,5));
    }


}