<?php

namespace Sdr\Handler;

use Sdr\Command\AddSkuToBasketCommand;
use Sdr\Domain\BasketItem;
use Sdr\Domain\BasketItemId;
use Sdr\Domain\SessionId;
use Sdr\Domain\SkuCode;
use Sdr\Repository\BasketWriteRepository;

class AddSkuToBasketHandler
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

    public function handle(AddSkuToBasketCommand $command): void
    {
        $basket = $this->basketWriteRepository->getBySession(
            new SessionId(session_id())
        );

        $basket->addItem(
            new BasketItem(
                BasketItemId::create(null),
                $basket,
                SkuCode::create($command->getSkuCode()),
                1
            )
        );
        $this->basketWriteRepository->persist($basket);
    }
}
