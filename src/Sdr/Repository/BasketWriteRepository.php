<?php

namespace Sdr\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Sdr\Domain\Basket;
use Sdr\Domain\BasketId;
use Sdr\Domain\SessionId;

class BasketWriteRepository
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

    /**
     * @param SessionId $sessionId
     * @return Basket
     */
    public function getBySession(SessionId $sessionId) : Basket
    {
        $rep = $this->entityManager->getRepository(Basket::class);
        $basket = $rep->findOneBy(['sessionId' => (string) $sessionId]);

        if ($basket === null) {
            $basket = new Basket(
                BasketId::create(null),
                new SessionId(session_id()),
                new \DateTimeImmutable(),
                new \DateTimeImmutable()
            );
        }

        return $basket;
    }

    public function persist(Basket $basket) : void
    {
        $this->entityManager->persist($basket);
        $this->entityManager->flush();
    }
}
