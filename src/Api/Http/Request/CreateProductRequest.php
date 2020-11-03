<?php

declare(strict_types=1);

namespace Api\Http\Request;

use Api\Http\Request\CreateProductRequest\Price;

final class CreateProductRequest
{
    public string $name;

    public Price $price;
}
