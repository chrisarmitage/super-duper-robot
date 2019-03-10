<?php

namespace Sdr\Command;

use Sdr\Domain\OrderId;
use Sdr\Domain\SessionId;

class PlaceOrderCommand implements CommandInterface
{
    /**
     * @var SessionId
     */
    protected $sessionId;

    /**
     * @var OrderId
     */
    protected $orderId;

    /**
     * PlaceOrderCommand constructor.
     * @param SessionId $sessionId
     * @param OrderId   $orderId
     */
    public function __construct(SessionId $sessionId, OrderId $orderId)
    {
        $this->sessionId = $sessionId;
        $this->orderId = $orderId;
    }

    /**
     * @return SessionId
     */
    public function getSessionId(): SessionId
    {
        return $this->sessionId;
    }

    /**
     * @return OrderId
     */
    public function getOrderId(): OrderId
    {
        return $this->orderId;
    }
}
