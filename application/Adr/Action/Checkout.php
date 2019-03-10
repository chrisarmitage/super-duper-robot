<?php

namespace Application\Adr\Action;

use Framework\Controller;
use Sdr\Command\PlaceOrderCommand;
use Sdr\CommandBus;
use Sdr\Domain\OrderId;
use Sdr\Domain\SessionId;

class Checkout implements Controller
{
    /**
     * @var CommandBus
     */
    protected $commandBus;

    /**
     * @var CheckoutResponder
     */
    protected $responder;

    /**
     * @param CommandBus        $commandBus
     * @param CheckoutResponder $responder
     */
    public function __construct(CommandBus $commandBus, CheckoutResponder $responder)
    {
        $this->commandBus = $commandBus;
        $this->responder = $responder;
    }

    public function dispatch()
    {
        $orderId = OrderId::create(null);

        $this->commandBus->execute(
            new PlaceOrderCommand(
                new SessionId(session_id()),
                $orderId
            )
        );

        return $this->responder->respond($orderId);
    }
}
