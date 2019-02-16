<?php

declare(strict_types=1);

namespace Application\Controller\Orders\Action;

use Framework\Controller;
use Framework\Router\RestRoute;
use Sdr\Command\DispatchOrderCommand;
use Sdr\CommandBus;

class Dispatch implements Controller
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
            new DispatchOrderCommand((int) $this->route->getResourceId())
        );

        return true;
    }
}
