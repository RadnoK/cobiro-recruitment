<?php

declare(strict_types=1);

use Api\Http\Controller\CreateProductAction;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes): void {
    $routes
        ->add('create', '/products')
        ->methods(['POST'])
        ->controller(CreateProductAction::class)
    ;
};
