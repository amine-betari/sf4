<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 19/03/20
 * Time: 10:51
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Component\Cache\Adapter\TagAwareAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\RedisAdapter;



class CachingController extends AbstractController
{
    private $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
        $this->cache = new TagAwareAdapter(
        // Adapter for cached items
            new FilesystemAdapter()
        );

    }

    /**
     * @Route("/cache/first",
     *     name="cache_first"
     * )
     */
    public function test()
    {

        // create a new item by trying to get it from the cache
        $item = $this->cache->getItem('stats.products_count');

        // $item = $this->cache->getItem('cache_key');

        if ($item->isHit()) {
            dump ('Item is Hit');
            dump($item);
            return new Response("OK HIT");
        }

        // assign a value to the item and save it
        $item->set(4711);
        $item->tag('tag_1');
        $item->tag(array('tag_2', 'tag_3'));

        // $item->expiresAfter(30);

        $this->cache->save($item);
        dump('INFO IS Store in Cache. Relaod the Page');
        die;
        new Response('OK');
    }
    /**
     * @Route("/cache/clear",
     *     name="cache_clear"
     * )
     */
    public function clear()
    {

        // If you don't remember the item key, you can use the getKey() method
            // $this->cache->deleteItem('stats.products_count');

        // invalidate all items related to `tag_1` or `tag_3`
        $this->cache->invalidateTags(['tag_1', 'tag_2', 'tag_3']);

        die;
        new Response('OK');
    }

}