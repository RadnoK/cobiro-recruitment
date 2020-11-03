<?php

declare(strict_types=1);

namespace Api\Http\Request\CreateProductRequest;

final class Price
{
    public int $amount;

    public string $currency;
}
