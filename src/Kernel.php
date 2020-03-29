<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\RouteCollectionBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

use App\DependencyInjection\Compiler\MailTransportPass;
use App\DependencyInjection\Compiler\PrintingCompilerPass;

//require dirname(__DIR__).'/vendor/autoload.php';
// require __DIR__.'/vendor/autoload.php';

class Kernel extends BaseKernel implements CompilerPassInterface
{
    use MicroKernelTrait;

    private const CONFIG_EXTS = '.{php,xml,yaml,yml}';

    public function registerBundles(): iterable
    {
        $contents = require $this->getProjectDir().'/config/bundles.php';
        foreach ($contents as $class => $envs) {
            if ($envs[$this->environment] ?? $envs['all'] ?? false) {
                yield new $class();
            }
        }
    }

    public function getProjectDir(): string
    {
        return \dirname(__DIR__);
    }

    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
    {
        $container->addResource(new FileResource($this->getProjectDir().'/config/bundles.php'));
        $container->setParameter('container.dumper.inline_class_loader', true);
        $confDir = $this->getProjectDir().'/config';

        $loader->load($confDir.'/{packages}/*'.self::CONFIG_EXTS, 'glob');
        $loader->load($confDir.'/{packages}/'.$this->environment.'/**/*'.self::CONFIG_EXTS, 'glob');
        $loader->load($confDir.'/{services}'.self::CONFIG_EXTS, 'glob');
        $loader->load($confDir.'/{services}_'.$this->environment.self::CONFIG_EXTS, 'glob');
    }

    protected function configureRoutes(RouteCollectionBuilder $routes): void
    {
        $confDir = $this->getProjectDir().'/config';

        $routes->import($confDir.'/{routes}/'.$this->environment.'/**/*'.self::CONFIG_EXTS, '/', 'glob');
        $routes->import($confDir.'/{routes}/*'.self::CONFIG_EXTS, '/', 'glob');
        $routes->import($confDir.'/{routes}'.self::CONFIG_EXTS, '/', 'glob');
    }

    // If you don't implements CompilerPassInterface
    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new MailTransportPass());

        $container->addCompilerPass(new PrintingCompilerPass());

       /* $container->registerForAutoconfiguration(CustomInterface::class)
            ->addTag('app.custom_tag')
        ;*/
    }

    public function process(ContainerBuilder $container)
    {
        // in this method you can manipulate the service container:
        // for example, changing some container service:
      /*  $container->getDefinition('App\Util\Rot13Transformer')->setPublic(true);

        foreach ($container->findTaggedServiceIds('kernel.event_listener') as $id => $tags) {
            // ...
            dump($id);
        }
      */
    }
}
