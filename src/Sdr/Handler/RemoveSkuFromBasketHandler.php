<?php

namespace Sdr\Handler;

use Sdr\Command\RemoveSkuFromBasketCommand;
use Sdr\Domain\SessionId;
use Sdr\Repository\BasketWriteRepository;

class RemoveSkuFromBasketHandler
{
    /**
     * @var BasketWriteRepository
     */
    protected $basketWriteRepository;

    /**
     * @param BasketWriteRepository $basketWriteRepository
     */
    public function __construct(BasketWriteRepository $basketWriteRepository)
    {
        $this->basketWriteRepository = $basketWriteRepository;
    }

    public function handle(RemoveSkuFromBasketCommand $command): void
    {
        $basket = $this->basketWriteRepository->getBySession(
            new SessionId(session_id())
        );

        $basket->removeItem(
            $command->getBasketItemId()
        );

        $this->basketWriteRepository->persist($basket);
    }
}
