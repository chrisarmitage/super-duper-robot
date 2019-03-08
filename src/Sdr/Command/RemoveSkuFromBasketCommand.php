<?php

namespace Sdr\Command;

use Sdr\Domain\BasketItemId;

class RemoveSkuFromBasketCommand implements CommandInterface
{
    /**
     * @var BasketItemId
     */
    protected $basketItemId;

    /**
     * @param BasketItemId $basketItemId
     */
    public function __construct(BasketItemId $basketItemId)
    {
        $this->basketItemId = $basketItemId;
    }

    /**
     * @return BasketItemId
     */
    public function getBasketItemId(): BasketItemId
    {
        return $this->basketItemId;
    }
}
