<?php

namespace Sdr\Repository;

use Sdr\Domain\Basket;
use Sdr\Domain\BasketId;
use Sdr\Domain\BasketItem;
use Sdr\Domain\BasketItemId;
use Sdr\Domain\SessionId;
use Sdr\Domain\SkuCode;

class BasketReadRepository
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getBySession(SessionId $sessionId)
    {
        $sth = $this->pdo->prepare('SELECT * FROM baskets WHERE session_id = :id LIMIT 1');
        $sth->execute(['id' => (string) $sessionId]);
        $row = $sth->fetch(\PDO::FETCH_ASSOC);

        if ($row === false) {
            $basket = new Basket(
                BasketId::create(null),
                new SessionId(session_id()),
                new \DateTimeImmutable(),
                new \DateTimeImmutable()
            );

            return $basket;
        }

        $basket = new Basket(
            BasketId::create($row['id']),
            new SessionId($row['session_id']),
            new \DateTimeImmutable($row['created']),
            new \DateTimeImmutable($row['modified'])
        );

        $sth = $this->pdo->prepare('SELECT * FROM basket_items WHERE basket_id = :id');
        $sth->execute(['id' => $row['id']]);
        $itemRows = $sth->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($itemRows as $itemRow) {
            $basket->addItem(
                new BasketItem(
                    BasketItemId::create($itemRow['id']),
                    $basket,
                    SkuCode::create($itemRow['sku_code']),
                    $itemRow['quantity']
                )
            );
        }

        return $basket;
    }
}
