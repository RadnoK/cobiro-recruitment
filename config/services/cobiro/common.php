<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Cobiro\Common\Application\System;
use Cobiro\Common\Infrastructure\Aeon\SystemCalendar;
use Cobiro\Common\Infrastructure\Doctrine\ORM\ORMTransactionManager;

return function (ContainerConfigurator $configurator): void {
    $services = $configurator
        ->services()
        ->defaults()
            ->autowire()
            ->autoconfigure()
    ;

    $services->set(ORMTransactionManager::class);
    $services->alias(System\TransactionManager::class, ORMTransactionManager::class);

    $services->set(SystemCalendar::class);
    $services->alias(System\Calendar::class, SystemCalendar::class);

    $services
        ->set(System::class)
        ->arg('$commandBus', service(System\CommandBus::class))
        ->arg('$logger', service('logger'))
        ->arg('$calendar', service(System\Calendar::class))
    ;
};
