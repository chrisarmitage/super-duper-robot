<?php

namespace Sdr\Handler;

use Sdr\Command\CreateOrderCommand;
use Sdr\Domain\Order;
use Sdr\Repository\OrderWriteRepository;

class CreateOrderHandler
{
    /**
     * @var OrderWriteRepository
     */
    protected $orderWriteRepository;

    /**
     * CreateOrderHandler constructor.
     * @param OrderWriteRepository $orderWriteRepository
     */
    public function __construct(OrderWriteRepository $orderWriteRepository)
    {
        $this->orderWriteRepository = $orderWriteRepository;
    }

    public function handle(CreateOrderCommand $command) : void
    {
        $order = new Order(
            $this->orderWriteRepository->nextIdentity(),
            $command->getCustomerId(),
            'NEW',
            $command->getValue()
        );

        $this->orderWriteRepository->add($order);
    }
}
