<?php

namespace Application\Controller\Orders;

use Framework\Controller;
use Framework\Router\RestRoute;
use Sdr\Command\CreateOrderCommand;
use Sdr\CommandBus;

class Create implements Controller
{
    /**
     * @var RestRoute
     */
    protected $route;

    /**
     * @var CommandBus
     */
    protected $commandBus;

    /**
     * Create constructor.
     * @param RestRoute  $route
     * @param CommandBus $commandBus
     */
    public function __construct(RestRoute $route, CommandBus $commandBus)
    {
        $this->route = $route;
        $this->commandBus = $commandBus;
    }

    public function dispatch()
    {
        $this->commandBus->execute(
            new CreateOrderCommand(
                mt_rand(5, 10),
                mt_rand(1000, 3000)
            )
        );

        return true;
    }
}
