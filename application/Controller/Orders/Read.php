<?php

declare(strict_types=1);

namespace Application\Controller\Orders;

use Framework\Controller;
use Framework\Router\RestRoute;
use Sdr\Domain\OrderId;
use Sdr\Repository\OrderReadRepository;

class Read implements Controller
{
    /**
     * @var OrderReadRepository
     */
    protected $orderReadRepository;

    /**
     * @var RestRoute
     */
    protected $route;

    /**
     * @param OrderReadRepository $orderReadRepository
     * @param RestRoute           $route
     */
    public function __construct(OrderReadRepository $orderReadRepository, RestRoute $route)
    {
        $this->orderReadRepository = $orderReadRepository;
        $this->route = $route;
    }

    public function dispatch()
    {
        $order = $this->orderReadRepository->get(
            OrderId::create($this->route->getResourceId())
        );

        $record = (object) [
            'id' => (string) $order->getId(),
            'state' => $order->getState(),
        ];

        return [
            'order' => $record,
        ];
    }
}
