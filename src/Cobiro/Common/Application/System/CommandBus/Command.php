<?php

declare(strict_types=1);

namespace Cobiro\Common\Application\System\CommandBus;

interface Command
{
    public function commandName(): string;
}
