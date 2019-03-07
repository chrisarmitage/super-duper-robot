<?php

namespace Sdr\Domain;

class SkuCode
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @param string $code
     */
    protected function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * @param string $code
     * @return static
     */
    public static function create(string $code)
    {
        return new static($code);
    }

    public function __toString()
    {
        return $this->code;
    }
}
