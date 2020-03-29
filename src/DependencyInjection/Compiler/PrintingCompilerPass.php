<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 27/03/20
 * Time: 17:20
 */

namespace App\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

use App\Printing\Printer;


class PrintingCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        // always first check if the primary service is defined
        if (!$container->has(Printer::class)) {
            dump("KO");
            return;
        }

        // Retrieves the definition of the service
        $printerDefinition = $container->findDefinition(Printer::class);

      //  dump($printerDefinition);


        // Retrieves the list of services' ids containing the tag
        $taggedServices = $container->findTaggedServiceIds('printing.formatter');

       // dump($taggedServices);

        foreach ($taggedServices as $id => $tagAttributes) {
            dump($id);
            foreach ($tagAttributes as $attributes) {
                $printerDefinition->addMethodCall(
                    'registerFormatter',
                    array($attributes['format'], new Reference($id))
                );
            }
        }

        dump("OK");

        foreach ($container->findTaggedServiceIds('kernel.event_listener') as $id => $tags) {
            // ...
            dump($id);
        }

     //   die;
    }

}