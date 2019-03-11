<?php

namespace Sdr\Handler;

use Sdr\Command\PlaceOrderCommand;
use Sdr\Domain\Order;
use Sdr\Domain\OrderItem;
use Sdr\Domain\OrderItemId;
use Sdr\Domain\Read\BasketItem;
use Sdr\Repository\BasketReadRepository;
use Sdr\Repository\BasketWriteRepository;
use Sdr\Repository\OrderWriteRepository;

class PlaceOrderHandler
{
    /**
     * @var BasketReadRepository
     */
    protected $basketReadRepository;

    /**
     * @var BasketWriteRepository
     */
    protected $basketWriteRepository;

    /**
     * @var OrderWriteRepository
     */
    protected $orderWriteRepository;

    /**
     * @param BasketReadRepository $basketReadRepository
     * @param BasketWriteRepository $basketWriteRepository
     * @param OrderWriteRepository  $orderWriteRepository
     */
    public function __construct(
        BasketReadRepository $basketReadRepository,
        BasketWriteRepository $basketWriteRepository,
        OrderWriteRepository $orderWriteRepository
    ) {
        $this->basketReadRepository = $basketReadRepository;
        $this->basketWriteRepository = $basketWriteRepository;
        $this->orderWriteRepository = $orderWriteRepository;
    }

    public function handle(PlaceOrderCommand $command) : void
    {
        $basket = $this->basketReadRepository->getBySession($command->getSessionId());

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
                    $basketItem->getTitle(),
                    $basketItem->getQuantity(),
                    $basketItem->getPrice()
                )
            );
        }

        $this->orderWriteRepository->add($order);
        $this->basketWriteRepository->remove(
            $this->basketWriteRepository->getBySession(
                $command->getSessionId()
            )
        );
    }
}
