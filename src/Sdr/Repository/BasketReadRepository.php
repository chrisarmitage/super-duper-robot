<?php

namespace Sdr\Repository;

use Sdr\Domain\Read\Basket;
use Sdr\Domain\Read\BasketItem;
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
            $basket = new Basket();

            return $basket;
        }

        $basket = new Basket();

        $sth = $this->pdo->prepare('SELECT * FROM basket_items AS bi JOIN skus AS s ON s.code = bi.sku_code WHERE basket_id = :id');
        $sth->execute(['id' => $row['id']]);
        $itemRows = $sth->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($itemRows as $itemRow) {
            $basket->addItem(
                new BasketItem(
                    BasketItemId::create($itemRow['id']),
                    SkuCode::create($itemRow['sku_code']),
                    $itemRow['quantity'],
                    $itemRow['price'],
                    $itemRow['title']
                )
            );
        }

        return $basket;
    }
}
