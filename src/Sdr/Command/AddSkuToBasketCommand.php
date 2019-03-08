<?php

namespace Sdr\Command;

use Sdr\Domain\SkuCode;

class AddSkuToBasketCommand implements CommandInterface
{
    /**
     * @var SkuCode
     */
    protected $skuCode;

    /**
     * @param SkuCode $skuCode
     */
    public function __construct(SkuCode $skuCode)
    {
        $this->skuCode = $skuCode;
    }

    /**
     * @return SkuCode
     */
    public function getSkuCode(): SkuCode
    {
        return $this->skuCode;
    }
}
