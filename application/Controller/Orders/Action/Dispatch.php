<?php

declare(strict_types=1);

namespace Application\Controller\Orders\Action;

use Framework\Controller;
use Framework\Router\RestRoute;
use Sdr\Repository\OrderWriteRepository;

class Dispatch implements Controller
{
    /**
     * @var OrderWriteRepository
     */
    protected $orderWriteRepository;

    /**
     * @var RestRoute
     */
    protected $route;

    /**
     * @param OrderWriteRepository $orderReadRepository
     * @param RestRoute            $route
     */
    public function __construct(OrderWriteRepository $orderReadRepository, RestRoute $route)
    {
        $this->orderWriteRepository = $orderReadRepository;
        $this->route = $route;
    }

    public function dispatch()
    {
        $order = [
            'id' => $this->route->getResourceId(),
            'state' => 'DISPATCHED',
        ];
        $this->orderWriteRepository->update($order);

        return true;
    }
}
