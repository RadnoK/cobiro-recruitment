<?php

declare(strict_types=1);

namespace Cobiro\Product\Application\Handler;

use Cobiro\Common\Application\System\Calendar;
use Cobiro\Common\Application\System\CommandBus\Handler;
use Cobiro\Product\Application\Command\CreateProductCommand;
use Cobiro\Product\Domain\Product;
use Cobiro\Product\Domain\Products;
use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;

final class CreateProductHandler implements Handler
{
    private Products $products;

    private Calendar $calendar;

    public function __construct(Products $products, Calendar $calendar)
    {
        $this->products = $products;
        $this->calendar = $calendar;
    }

    public function __invoke(CreateProductCommand $command): void
    {
        $this->products->save(new Product(
            Uuid::fromString($command->id()),
            $command->name(),
            new Money($command->priceAmount(), new Currency($command->priceCurrency())),
            $this->calendar->currentTime()
        ));
    }

    public function handles(): string
    {
        return CreateProductCommand::class;
    }
}
