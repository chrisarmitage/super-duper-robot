<?php

declare(strict_types=1);

namespace Application\Controller\Orders;

use Framework\Controller;
use Sdr\Repository\OrderReadRepository;

class Index implements Controller
{
    /**
     * @var OrderReadRepository
     */
    protected $orderReadRepository;

    /**
     * @param OrderReadRepository $orderReadRepository
     */
    public function __construct(OrderReadRepository $orderReadRepository)
    {
        $this->orderReadRepository = $orderReadRepository;
    }

    public function dispatch()
    {
        $orders = $this->orderReadRepository->getAll();

        $records = [];
        foreach ($orders as $order) {
            $records[] = (object) [
                'id' => (string) $order->getId(),
                'state' => $order->getState(),
            ];
        }

        return [
            'orders' => $records,
        ];
    }
}
