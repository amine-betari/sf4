<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 28/11/19
 * Time: 00:26
 */

namespace App\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

// abstract is error
// you must declate the methode load
abstract class AppExtension extends Extension
{
    public function getConfiguration(array $config, ContainerBuilder $container)
    {
        return new Configuration($container->getParameter('kernel.debug'));
    }

    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('doctrine.xml');
        $loader->load('form.xml');

    }
}