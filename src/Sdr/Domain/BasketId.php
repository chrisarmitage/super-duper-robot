<?php

namespace Sdr\Domain;

use Ramsey\Uuid\Uuid;

class BasketId
{
    /**
     * @var string
     */
    protected $id;

    /**
     * BasketId constructor.
     * @param null|string $id
     * @throws \Exception
     */
    protected function __construct(?string $id)
    {
        $this->id = $id ?: Uuid::uuid4()->toString();
    }

    /**
     * @param null|string $id
     * @return BasketId
     * @throws \Exception
     */
    public static function create(?string $id): BasketId
    {
        return new static($id);
    }

    public function __toString()
    {
        return $this->id;
    }
}
