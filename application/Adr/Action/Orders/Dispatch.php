<?php

namespace Application\Adr\Action\Orders;

use Framework\Controller;
use Sdr\Command\DispatchOrderCommand;
use Sdr\CommandBus;
use Sdr\Domain\OrderId;

class Dispatch implements Controller
{
    /**
     * @var CommandBus
     */
    protected $commandBus;

    /**
     * @var DispatchResponder
     */
    protected $responder;

    /**
     * Create constructor.
     * @param CommandBus      $commandBus
     * @param DispatchResponder $responder
     */
    public function __construct(CommandBus $commandBus, DispatchResponder $responder)
    {
        $this->commandBus = $commandBus;
        $this->responder = $responder;
    }

    public function dispatch($orderId)
    {
        $this->commandBus->execute(
            new DispatchOrderCommand(
                OrderId::create($orderId)
            )
        );

        return $this->responder->respond($orderId);
    }
}
