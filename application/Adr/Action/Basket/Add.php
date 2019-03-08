<?php

namespace Application\Adr\Action\Basket;

use Framework\Controller;
use Sdr\Command\AddSkuToBasketCommand;
use Sdr\CommandBus;
use Sdr\Domain\SkuCode;

class Add implements Controller
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
     * @param AddResponder $responder
     */
    public function __construct(CommandBus $commandBus, AddResponder $responder)
    {
        $this->commandBus = $commandBus;
        $this->responder = $responder;
    }

    public function dispatch($skuCode)
    {
        $this->commandBus->execute(
            new AddSkuToBasketCommand(
                SkuCode::create($skuCode)
            )
        );

        return $this->responder->respond($skuCode);
    }

}
