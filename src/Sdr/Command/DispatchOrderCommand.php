<?php

namespace Sdr\Command;

class DispatchOrderCommand implements CommandInterface
{
    /**
     * @var int
     */
    protected $orderId;

    /**
     * @param $orderId
     */
    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return int
     */
    public function getOrderId() : int
    {
        return $this->orderId;
    }
}
