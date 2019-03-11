<?php

namespace Sdr\Repository;

use Sdr\Domain\Order;
use Sdr\Domain\OrderId;
use Sdr\Domain\OrderItem;
use Sdr\Domain\OrderItemId;
use Sdr\Domain\SkuCode;

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

        $sth = $this->pdo->prepare('SELECT * FROM order_items WHERE order_id = :id');
        $sth->execute(['id' => $row['id']]);
        $itemRows = $sth->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($itemRows as $itemRow) {
            $order->addItem(
                new OrderItem(
                    OrderItemId::create($itemRow['id']),
                    $order,
                    SkuCode::create($itemRow['sku_code']),
                    $itemRow['sku_title'],
                    $itemRow['quantity'],
                    $itemRow['line_total']
                )
            );
        }

        return $order;
    }
}
