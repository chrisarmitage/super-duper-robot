<?php

namespace Application\Adr\Action\Orders;

use Framework\Controller;
use Sdr\Command\CreateOrderCommand;
use Sdr\CommandBus;

class Create implements Controller
{
    /**
     * @var CommandBus
     */
    protected $commandBus;

    /**
     * @var CreateResponder
     */
    protected $responder;

    /**
     * Create constructor.
     * @param CommandBus      $commandBus
     * @param CreateResponder $responder
     */
    public function __construct(CommandBus $commandBus, CreateResponder $responder)
    {
        $this->commandBus = $commandBus;
        $this->responder = $responder;
    }

    public function dispatch()
    {
        $this->commandBus->execute(
            new CreateOrderCommand(
                mt_rand(5, 10),
                mt_rand(1000, 3000)
            )
        );

        return $this->responder->respond();
    }
}
