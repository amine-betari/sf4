<?php
// config/routes.php
use App\Controller\BlogController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {

    $routes->add('blog_index', '/index/{page<\d+>?1987}')
        ->controller([BlogController::class, 'index'])
        ->methods(['POST', 'HEAD']);

    $routes->add('blog_index2', '/index/{page?1989}')
        ->controller([BlogController::class, 'index2'])
        ->methods(['GET'])

    ;
};