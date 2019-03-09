<?php

namespace Sdr\Domain\Read;

class Basket
{
    /**
     * @var BasketItem[]
     */
    protected $items = [];

    /**
     * @return int
     */
    public function getTotal(): int
    {
        $total = array_reduce(
            $this->items,
            function ($carry, $item) {
                /** @var BasketItem $item */
                $carry += $item->getPrice();

                return $carry;
            },
            0
        );

        return $total;
    }

    /**
     * @param BasketItem $item
     * @return $this
     */
    public function addItem(BasketItem $item) : self
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @return BasketItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
