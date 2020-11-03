<?php

declare(strict_types=1);

namespace Cobiro\Product\Domain;

interface Products
{
    public function save(Product $product): void;
}
