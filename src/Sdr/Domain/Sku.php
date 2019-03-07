<?php

namespace Sdr\Domain;

class Sku
{
    /**
     * @var SkuCode
     */
    protected $code;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var int
     */
    protected $price;

    /**
     * @var string|null
     */
    protected $image;

    /**
     * @param SkuCode     $code
     * @param string      $title
     * @param int         $price
     * @param null|string $image
     */
    public function __construct(SkuCode $code, string $title, int $price, ?string $image)
    {
        $this->code = $code;
        $this->title = $title;
        $this->price = $price;
        $this->image = $image;
    }

    /**
     * @return SkuCode
     */
    public function getCode(): SkuCode
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return null|string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }
}
