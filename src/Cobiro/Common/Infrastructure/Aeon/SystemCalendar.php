<?php

declare(strict_types=1);

namespace Cobiro\Common\Infrastructure\Aeon;

use Aeon\Calendar\Gregorian\GregorianCalendar;
use Cobiro\Common\Application\System\Calendar;

final class SystemCalendar implements Calendar
{
    public function currentTime(): \DateTimeImmutable
    {
        return GregorianCalendar::UTC()->now()->toDateTimeImmutable();
    }
}
