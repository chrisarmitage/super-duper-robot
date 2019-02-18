<?php

namespace Sdr\Domain;

use Ramsey\Uuid\Uuid;

class OrderId
{
    /**
     * @var string
     */
    protected $id;

    /**
     * OrderId constructor.
     * @param null|string $id
     * @throws \Exception
     */
    protected function __construct(?string $id) {
        $this->id = $id ?: Uuid::uuid4()->toString();
    }

    /**
     * @param null|string $id
     * @return OrderId
     * @throws \Exception
     */
    public static function create(?string $id) {
        return new static($id);
    }

    public function __toString()
    {
        return $this->id;
    }
}
