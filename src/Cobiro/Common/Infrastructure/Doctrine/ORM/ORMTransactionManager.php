<?php

declare(strict_types=1);

namespace Cobiro\Common\Infrastructure\Doctrine\ORM;

use Cobiro\Common\Application\System\TransactionManager;
use Doctrine\ORM\EntityManagerInterface;

final class ORMTransactionManager implements TransactionManager
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function begin(): void
    {
        $this->entityManager->beginTransaction();
    }

    public function commit(): void
    {
        $this->entityManager->flush();
        $this->entityManager->commit();
    }

    public function rollback(): void
    {
        $this->entityManager->rollback();
    }
}
