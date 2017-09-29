<?php
use Core\Dispatcher;
use function DI\object;
use Psr\Container\ContainerInterface;

return [
    'core_router' => object(\Core\Router::class),
    'core_dispatcher' => function (ContainerInterface $c) {
        // pass container to dispatcher
        return new Dispatcher($c);
    },
    'App\Controller\*Controller' => DI\factory([\Core\Controller\ControllerFactory::class, 'create'])

];
