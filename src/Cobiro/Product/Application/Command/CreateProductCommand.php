<?php

declare(strict_types=1);

namespace Cobiro\Product\Application\Command;

use Cobiro\Common\Application\System\CommandBus\Command;

final class CreateProductCommand implements Command
{
    private string $id;

    private string $name;

    private int $priceAmount;

    private string $priceCurrency;

    public function __construct(string $id, string $name, int $priceAmount, string $priceCurrency)
    {
        $this->id = $id;
        $this->name = $name;
        $this->priceAmount = $priceAmount;
        $this->priceCurrency = $priceCurrency;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function priceAmount(): int
    {
        return $this->priceAmount;
    }

    public function priceCurrency(): string
    {
        return $this->priceCurrency;
    }

    public function commandName(): string
    {
        return self::class;
    }
}
