<?php

namespace Sdr\Domain\Read;

use Sdr\Domain\BasketItemId;
use Sdr\Domain\SkuCode;

class BasketItem
{
    /**
     * @var BasketItemId
     */
    protected $id;

    /**
     * @var SkuCode
     */
    protected $skuCode;

    /**
     * @var integer
     */
    protected $quantity;

    /**
     * @var integer
     */
    protected $price;

    /**
     * @var string
     */
    protected $title;

    /**
     * BasketItem constructor.
     * @param BasketItemId $id
     * @param SkuCode      $skuCode
     * @param int          $quantity
     * @param int          $price
     * @param string       $title
     */
    public function __construct(BasketItemId $id, SkuCode $skuCode, int $quantity, int $price, string $title)
    {
        $this->id = $id;
        $this->skuCode = $skuCode;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->title = $title;
    }

    /**
     * @return BasketItemId
     */
    public function getId(): BasketItemId
    {
        return $this->id;
    }

    /**
     * @return SkuCode
     */
    public function getSkuCode(): SkuCode
    {
        return $this->skuCode;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}
