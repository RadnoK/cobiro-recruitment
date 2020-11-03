<?php

declare(strict_types=1);

namespace Api\Console\Command;

use Api\Console\Code\ReturnCode;
use Cobiro\Common\Application\System;
use Cobiro\Product\Application;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class CreateProductCommand extends Command
{
    private const COMMAND_NAME = 'cobiro:product:create';

    private System $system;

    private SymfonyStyle $io;

    public function __construct(System $system)
    {
        parent::__construct(self::COMMAND_NAME);

        $this->system = $system;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'Name of the product')
            ->addArgument('priceAmount', InputArgument::REQUIRED, 'Price of the product')
            ->addArgument('priceCurrency', InputArgument::REQUIRED, 'Currency of the price')
        ;
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->system->handle(new Application\Command\CreateProductCommand(
                $id = Uuid::uuid4()->toString(),
                $input->getArgument('name'),
                (int) $input->getArgument('priceAmount'),
                $input->getArgument('priceCurrency')
            ));
        } catch (System\Exception\Exception $exception) {
            $this->io->error('Could not perform operation.');

            return ReturnCode::CRITICAL_ERROR;
        }

        $this->io->success(\sprintf('Successfully created product with ID: %s', $id));

        return ReturnCode::SUCCESS;
    }
}
