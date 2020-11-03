<?php

declare(strict_types=1);

namespace Cobiro\Common\Application;

use Cobiro\Common\Application\System\Calendar;
use Cobiro\Common\Application\System\CommandBus;
use Cobiro\Common\Application\System\CommandBus\Command;
use Cobiro\Common\Application\System\Exception\Exception;
use Psr\Log\LoggerInterface;

class System
{
    private CommandBus $commandBus;

    private LoggerInterface $logger;

    private Calendar $calendar;

    public function __construct(CommandBus $commandBus, LoggerInterface $logger, Calendar $calendar)
    {
        $this->commandBus = $commandBus;
        $this->logger = $logger;
        $this->calendar = $calendar;
    }

    /**
     * @throws Exception
     */
    public function handle(Command $command): void
    {
        try {
            $this->commandBus->handle($command);
        } catch (\Throwable $exception) {
            $this->logger->error(
                \sprintf('Failed to handle "%s" command', \get_class($command)),
                [
                    'time' => $this->calendar->currentTime()->format('c'),
                    'exception' => \get_class($exception),
                    'message' => $exception->getMessage(),
                    'code' => $exception->getCode(),
                    'stacktrace' => $exception->getTraceAsString(),
                ]
            );

            throw new Exception($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    public function getCalendar(): Calendar
    {
        return $this->calendar;
    }
}
