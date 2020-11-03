<?php

declare(strict_types=1);

namespace Cobiro\Product\Infrastructure\Doctrine\ORM\Domain;

use Cobiro\Product\Domain\Product;
use Cobiro\Product\Domain\Products;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

final class ORMProducts implements Products
{
    private EntityManagerInterface $entityManager;

    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Product::class);
    }

    public function save(Product $product): void
    {
        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }
}
