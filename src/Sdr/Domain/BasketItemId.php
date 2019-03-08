<?php

namespace Sdr\Domain;

use Ramsey\Uuid\Uuid;

class BasketItemId
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
     * @return BasketItemId
     * @throws \Exception
     */
    public static function create(?string $id): BasketItemId
    {
        return new static($id);
    }

    public function __toString()
    {
        return $this->id;
    }

    public function equals(BasketItemId $other): bool
    {
        return $this->id === (string) $other;
    }
}
