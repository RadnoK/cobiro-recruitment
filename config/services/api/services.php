<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return function (ContainerConfigurator $configurator): void {
    $services = $configurator
        ->services()
        ->defaults()
            ->autowire()
            ->autoconfigure()
    ;

    $services
        ->load('Api\\Console\\Command\\', __DIR__ . '/../../../src/Api/Console/Command/*')
        ->tag('console.command')
    ;

    $services
        ->load('Api\\Http\\Controller\\', __DIR__ . '/../../../src/Api/Http/Controller/*')
        ->tag('controller.service_arguments')
    ;
};
