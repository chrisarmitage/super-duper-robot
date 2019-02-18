<?php

namespace Sdr\Domain;

class Order
{
    /**
     * @var OrderId
     */
    protected $id;

    /**
     * @var int|null
     */
    protected $customerId;

    /**
     * @var string
     */
    protected $state;

    /**
     * @var int
     */
    protected $total;

    /**
     * Order constructor.
     * @param OrderId  $id
     * @param int|null $customerId
     * @param string   $state
     * @param int      $total
     */
    public function __construct(OrderId $id, ?int $customerId, string $state, int $total)
    {
        $this->id = $id;
        $this->customerId = $customerId;
        $this->state = $state;
        $this->total = $total;
    }

    /**
     * @return OrderId
     */
    public function getId(): OrderId
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    public function changeState(string $state) : self
    {
        $this->state = $state;

        return $this;
    }
}
