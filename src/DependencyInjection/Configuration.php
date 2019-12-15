<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 28/11/19
 * Time: 00:25
 */

namespace App\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    private $debug;

    public function  __construct($debug)
    {
        $this->debug = (bool) $debug;
    }

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('my_bundle');

        $rootNode
            ->children()
            // ...
            ->booleanNode('logging')->defaultValue($this->debug)->end()
            // ...
            ->end()
        ;

        return $treeBuilder;
    }
}