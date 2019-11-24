<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 15/11/19
 * Time: 22:12
 */

// config/services.php
use App\Controller\LuckyController;
use Symfony\Component\DependencyInjection\Reference;

$container->register(LuckyController::class)
    ->setPublic(true)
    ->setBindings([
        '$logger' => new Reference('monolog.logger.doctrine'),
        '$adminEmail' => '%kernel.project_dir%'
    ])
;
