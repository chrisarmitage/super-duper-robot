<?php

namespace Sdr\Repository;

use Sdr\Domain\Sku;
use Sdr\Domain\SkuCode;

class SkuReadRepository
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
     * @return Sku[]
     * @throws \Exception
     */
    public function getAll() : array
    {
        $sth = $this->pdo->prepare('SELECT * FROM skus');
        $sth->execute();
        $rows = $sth->fetchAll(\PDO::FETCH_ASSOC);

        $skus = [];
        foreach ($rows as $row) {
            $skus[] = new Sku(
                SkuCode::create($row['code']),
                $row['title'],
                $row['price'],
                $row['image']
            );
        }

        return $skus;
    }
}
