<?php

declare(strict_types=1);

namespace Cobiro\Common\Application;

use Assert\Assertion as BaseAssertion;
use Cobiro\Common\Application\System\Exception\InvalidAssertionException;

final class Assertion extends BaseAssertion
{
    protected static $exceptionClass = InvalidAssertionException::class;
}
