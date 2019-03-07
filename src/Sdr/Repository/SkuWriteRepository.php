<?php

namespace Sdr\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Sdr\Domain\Sku;

class SkuWriteRepository
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function persist(Sku $sku): void
    {
        $this->entityManager->persist($sku);
        $this->entityManager->flush();
    }
}
