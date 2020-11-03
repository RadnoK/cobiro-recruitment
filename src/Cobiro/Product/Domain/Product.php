<?php

declare(strict_types=1);

namespace Cobiro\Product\Domain;

use Money\Money;
use Ramsey\Uuid\UuidInterface;

class Product
{
    private UuidInterface $id;

    private string $name;

    private Money $price;

    private \DateTimeImmutable $createdAt;

    public function __construct(UuidInterface $id, string $name, Money $price, \DateTimeImmutable $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->createdAt = $createdAt;
    }
}
