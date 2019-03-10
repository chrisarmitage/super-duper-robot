<?php

namespace Sdr\Handler;

use Sdr\Command\PlaceOrderCommand;
use Sdr\Domain\BasketItem;
use Sdr\Domain\Order;
use Sdr\Domain\OrderItem;
use Sdr\Domain\OrderItemId;
use Sdr\Repository\BasketWriteRepository;
use Sdr\Repository\OrderWriteRepository;

class PlaceOrderHandler
{
    /**
     * @var BasketWriteRepository
     */
    protected $basketWriteRepository;

    /**
     * @var OrderWriteRepository
     */
    protected $orderWriteRepository;

    /**
     * @param BasketWriteRepository $basketWriteRepository
     * @param OrderWriteRepository  $orderWriteRepository
     */
    public function __construct(BasketWriteRepository $basketWriteRepository, OrderWriteRepository $orderWriteRepository)
    {
        $this->basketWriteRepository = $basketWriteRepository;
        $this->orderWriteRepository = $orderWriteRepository;
    }

    public function handle(PlaceOrderCommand $command) : void
    {
        $basket = $this->basketWriteRepository->getBySession($command->getSessionId());

        $order = new Order(
            $command->getOrderId(),
            1,
            'PENDING',
            0
        );

        /** @var BasketItem $basketItem */
        foreach ($basket->getItems() as $basketItem) {
            $order->addItem(
                new OrderItem(
                    OrderItemId::create(null),
                    $order,
                    $basketItem->getSkuCode(),
                    $basketItem->getQuantity(),
                    0
                )
            );
        }

        $this->orderWriteRepository->add($order);
        $this->basketWriteRepository->remove($basket);
    }
}
