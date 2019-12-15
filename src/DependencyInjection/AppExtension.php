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

// abstract is error
// you must declate the methode load
abstract class AppExtension extends Extension
{
    public function getConfiguration(array $config, ContainerBuilder $container)
    {
        return new Configuration($container->getParameter('kernel.debug'));
    }
}