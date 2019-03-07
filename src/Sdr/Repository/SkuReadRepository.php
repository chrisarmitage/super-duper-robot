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
     * SkuReadRepository constructor.
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

    /**
     * @param SkuCode $skuCode
     * @return Sku
     */
    public function get(SkuCode $skuCode) : Sku
    {
        $sth = $this->pdo->prepare('SELECT * FROM skus WHERE code = :code LIMIT 1');
        $sth->execute(['code' => (string) $skuCode]);
        $row = $sth->fetch(\PDO::FETCH_ASSOC);

        $sku = new Sku(
            SkuCode::create($row['code']),
            $row['title'],
            $row['price'],
            null
        );

        return $sku;
    }
}
