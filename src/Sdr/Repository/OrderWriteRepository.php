<?php

namespace Sdr\Repository;

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

    public function update(array $order) : void
    {
        $sth = $this->pdo->prepare('UPDATE orders SET state = :state WHERE id = :id');
        $sth->execute(['id' => $order['id'], 'state' => $order['state']]);
    }
}
