<?php

namespace Sdr\Domain;

class SessionId
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->id;
    }
}
