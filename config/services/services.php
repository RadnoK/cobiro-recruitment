<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return function (ContainerConfigurator $configurator): void {
    $configurator->import(__DIR__ . '/api/*.php');
    $configurator->import(__DIR__ . '/cobiro/*.php');
};
