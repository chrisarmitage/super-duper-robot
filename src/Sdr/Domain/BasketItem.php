<?php

namespace Sdr\Domain;

class BasketItem
{
    /**
     * @var BasketItemId
     */
    protected $id;

    /**
     * @var Basket
     */
    protected $basket;

    /**
     * @var SkuCode
     */
    protected $skuCode;

    /**
     * @var integer
     */
    protected $quantity;

    /**
     * @param BasketItemId $id
     * @param Basket       $basket
     * @param SkuCode      $skuCode
     * @param int          $quantity
     */
    public function __construct(BasketItemId $id, Basket $basket, SkuCode $skuCode, int $quantity)
    {
        $this->id = $id;
        $this->skuCode = $skuCode;
        $this->quantity = $quantity;
        $this->basket = $basket;
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
}
