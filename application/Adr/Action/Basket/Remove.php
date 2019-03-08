<?php

namespace Application\Adr\Action\Basket;

use Framework\Controller;
use Sdr\Command\RemoveSkuFromBasketCommand;
use Sdr\CommandBus;
use Sdr\Domain\BasketItemId;

class Remove implements Controller
{
    /**
     * @var CommandBus
     */
    protected $commandBus;

    /**
     * @var AddResponder
     */
    protected $responder;

    /**
     * @param CommandBus      $commandBus
     * @param RemoveResponder $responder
     */
    public function __construct(CommandBus $commandBus, RemoveResponder $responder)
    {
        $this->commandBus = $commandBus;
        $this->responder = $responder;
    }

    public function dispatch($basketItemId)
    {
        $this->commandBus->execute(
            new RemoveSkuFromBasketCommand(
                BasketItemId::create($basketItemId)
            )
        );

        return $this->responder->respond();
    }

}
