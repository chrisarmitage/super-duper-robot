<?php

namespace Sdr\Repository;

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

    public function getAll()
    {
        $sth = $this->pdo->prepare('SELECT * FROM orders');
        $sth->execute();
        $rows = $sth->fetchAll(\PDO::FETCH_ASSOC);

        $orders = [];
        foreach ($rows as $row) {
            $orders[] = (object) [
                'id' => $row['id'],
                'state' => $row['state'],
            ];
        }

        return $orders;
    }

    public function get($orderId)
    {
        $sth = $this->pdo->prepare('SELECT * FROM orders WHERE id = :id LIMIT 1');
        $sth->execute(['id' => $orderId]);
        $row = $sth->fetch(\PDO::FETCH_ASSOC);

        $order = (object) [
            'id' => $row['id'],
            'state' => $row['state'],
        ];

        return $order;
    }
}
