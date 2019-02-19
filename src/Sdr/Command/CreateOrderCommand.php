<?php

namespace Sdr\Command;

class CreateOrderCommand implements CommandInterface
{
    /**
     * @var int
     */
    protected $customerId;

    /**
     * @var int
     */
    protected $value;

    /**
     * CreateOrderCommand constructor.
     * @param int $customerId
     * @param int $value
     */
    public function __construct(int $customerId, int $value)
    {
        $this->customerId = $customerId;
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
