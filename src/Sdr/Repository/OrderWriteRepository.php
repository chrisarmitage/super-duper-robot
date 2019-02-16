<?php

namespace Sdr\Repository;

use Sdr\Domain\Order;

class OrderWriteRepository
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
     * @param $orderId
     * @return Order
     */
    public function get($orderId) : Order
    {
        $sth = $this->pdo->prepare('SELECT * FROM orders WHERE id = :id LIMIT 1');
        $sth->execute(['id' => $orderId]);
        $row = $sth->fetch(\PDO::FETCH_ASSOC);

        $order = new Order(
            $row['id'],
            null,
            $row['state'],
            0
        );

        return $order;
    }

    public function update(Order $order) : void
    {
        $sth = $this->pdo->prepare('UPDATE orders SET state = :state WHERE id = :id');
        $sth->execute(
            [
                'id' => $order->getId(),
                'state' => $order->getState(),
            ]
        );
    }
}
