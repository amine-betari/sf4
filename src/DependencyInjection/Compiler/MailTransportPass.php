<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 01/12/19
 * Time: 01:11
 */

namespace App\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;
use App\Mail\TransportChain;

class MailTransportPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        // always first check if the primary service is defined
        if (!$container->has(TransportChain::class)) {
            return;
        }

        $definition = $container->findDefinition(TransportChain::class);

        // find all service IDs with the app.mail_transport tag
        $taggedServices = $container->findTaggedServiceIds('app.mail_transport');

        foreach ($taggedServices as $id => $tags) {
            // add the transport service to the ChainTransport service
             // $definition->addMethodCall('addTransport', array(new Reference($id)));
            // a service could have the same tag twice
            foreach ($tags as $attributes) {
                $definition->addMethodCall('addTransport', array(
                    new Reference($id),
                    $attributes["alias"]
                ));
            }
        }
    }
}