<?php

namespace Sdr\Repository;

use Sdr\Domain\Order;
use Sdr\Domain\OrderId;

class OrderReadRepository
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * OrderReadRepository constructor.
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return Order[]
     * @throws \Exception
     */
    public function getAll() : array
    {
        $sth = $this->pdo->prepare('SELECT * FROM orders');
        $sth->execute();
        $rows = $sth->fetchAll(\PDO::FETCH_ASSOC);

        $orders = [];
        foreach ($rows as $row) {
            $orders[] = new Order(
                OrderId::create($row['id']),
                $row['customer_id'],
                $row['state'],
                $row['total']
            );
        }

        return $orders;
    }

    /**
     * @param OrderId $orderId
     * @return Order
     */
    public function get(OrderId $orderId) : Order
    {
        $sth = $this->pdo->prepare('SELECT * FROM orders WHERE id = :id LIMIT 1');
        $sth->execute(['id' => (string) $orderId]);
        $row = $sth->fetch(\PDO::FETCH_ASSOC);

        $order = new Order(
            OrderId::create($row['id']),
            null,
            $row['state'],
            0
        );

        return $order;
    }
}
