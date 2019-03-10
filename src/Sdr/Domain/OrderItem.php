<?php

namespace Sdr\Domain;

class OrderItem
{
    /**
     * @var OrderItemId
     */
    protected $id;

    /**
     * @var Order
     */
    protected $order;

    /**
     * @var SkuCode
     */
    protected $skuCode;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var int
     */
    protected $lineTotal;

    /**
     * @param OrderItemId $id
     * @param Order       $order
     * @param SkuCode     $skuCode
     * @param int         $quantity
     * @param int         $lineTotal
     */
    public function __construct(
        OrderItemId $id,
        Order $order,
        SkuCode $skuCode,
        int $quantity,
        int $lineTotal
    ) {
        $this->id = $id;
        $this->order = $order;
        $this->skuCode = $skuCode;
        $this->quantity = $quantity;
        $this->lineTotal = $lineTotal;
    }

    /**
     * @return OrderItemId
     */
    public function getId(): OrderItemId
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
    public function getLineTotal(): int
    {
        return $this->lineTotal;
    }
}
