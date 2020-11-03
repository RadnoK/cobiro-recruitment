<?php

declare(strict_types=1);

namespace Cobiro\Common\Application\System;

interface Calendar
{
    public function currentTime(): \DateTimeImmutable;
}
