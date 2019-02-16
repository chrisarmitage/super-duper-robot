<?php

namespace Sdr\Handler;

use Sdr\Command\DispatchOrderCommand;
use Sdr\Repository\OrderWriteRepository;

class DispatchOrderHandler
{
    /**
     * @var OrderWriteRepository
     */
    protected $orderWriteRepository;

    /**
     * @param OrderWriteRepository $orderWriteRepository
     */
    public function __construct(OrderWriteRepository $orderWriteRepository)
    {
        $this->orderWriteRepository = $orderWriteRepository;
    }

    public function handle(DispatchOrderCommand $command) : void
    {
        $order = $this->orderWriteRepository->get($command->getOrderId());
        $order->changeState('DISPATCHED');
        $this->orderWriteRepository->update($order);
    }
}
