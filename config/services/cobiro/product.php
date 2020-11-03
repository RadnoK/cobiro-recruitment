<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Cobiro\Common\Application\System;
use Cobiro\Product\Domain\Products;
use Cobiro\Product\Infrastructure\Doctrine\ORM\Domain\ORMProducts;

return function (ContainerConfigurator $configurator): void {
    $services = $configurator
        ->services()
        ->defaults()
            ->autowire()
            ->autoconfigure()
    ;

    $services
        ->load('Cobiro\\Product\\Application\\Handler\\', __DIR__ . '/../../../src/Cobiro/Product/Application/Handler/*')
        ->tag('cobiro.product.handler')
    ;

    $services
        ->set(System\CommandBus::class)
        ->arg('$transactionManager', service(System\TransactionManager::class))
        ->arg('$handlers', tagged_iterator('cobiro.product.handler'))
    ;

    $services->set(ORMProducts::class);
    $services->alias(Products::class, ORMProducts::class);
};
