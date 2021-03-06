<?php

namespace Sdr\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Sdr\Domain\Order;
use Sdr\Domain\OrderId;

class OrderWriteRepository
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

    public function nextIdentity() : Orderid
    {
        return OrderId::create(null);
    }

    /**
     * @param OrderId $orderId
     * @return Order
     */
    public function get(OrderId $orderId) : Order
    {
        $order = $this->entityManager->find(Order::class, (string) $orderId);

        return $order;
    }

    public function add(Order $order) : void
    {
        $this->entityManager->persist($order);
        $this->entityManager->flush();
    }

    public function update(Order $order) : void
    {
        $this->entityManager->persist($order);
        $this->entityManager->flush();
    }
}
