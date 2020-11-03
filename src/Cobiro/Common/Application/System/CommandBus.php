<?php

declare(strict_types=1);

namespace Cobiro\Common\Application\System;

use Cobiro\Common\Application\Assertion;
use Cobiro\Common\Application\System\CommandBus\Command;
use Cobiro\Common\Application\System\CommandBus\Handler;
use Cobiro\Common\Application\System\Exception\Exception;

final class CommandBus
{
    private TransactionManager $transactionManager;

    /** @var Handler[] */
    private array $handlers = [];

    public function __construct(TransactionManager $transactionManager, iterable $handlers)
    {
        foreach ($handlers as $handler) {
            Assertion::methodExists('__invoke', $handler, 'Could not register handler without __invoke method.');

            $this->handlers[$handler->handles()] = $handler;
        }

        $this->transactionManager = $transactionManager;
    }

    public function handle(Command $command): void
    {
        if (\array_key_exists($command->commandName(), $this->handlers)) {
            $this->transactionManager->begin();

            try {
                $this->handlers[$command->commandName()]($command);
                $this->transactionManager->commit();
            } catch (\Throwable $exception) {
                $this->transactionManager->rollback();

                throw $exception;
            }
        } else {
            throw new Exception(sprintf('Unknown command "%s"', $command->commandName()));
        }
    }
}
