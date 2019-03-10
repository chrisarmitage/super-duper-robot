<?php

namespace Sdr\Domain;

use Ramsey\Uuid\Uuid;

class OrderItemId
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @param null|string $id
     * @throws \Exception
     */
    protected function __construct(?string $id)
    {
        $this->id = $id ?: Uuid::uuid4()->toString();
    }

    /**
     * @param null|string $id
     * @return OrderItemId
     * @throws \Exception
     */
    public static function create(?string $id): self
    {
        return new static($id);
    }

    public function __toString()
    {
        return $this->id;
    }

    public function equals(OrderItemId $other): bool
    {
        return $this->id === (string) $other;
    }
}
