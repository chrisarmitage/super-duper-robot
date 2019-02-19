<?php

namespace Sdr\Command;

use Sdr\Domain\OrderId;

class DispatchOrderCommand implements CommandInterface
{
    /**
     * @var OrderId
     */
    protected $orderId;

    /**
     * @param OrderId $orderId
     */
    public function __construct(OrderId $orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return OrderId
     */
    public function getOrderId() : OrderId
    {
        return $this->orderId;
    }
}
