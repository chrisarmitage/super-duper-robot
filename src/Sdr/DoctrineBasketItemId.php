<?php

namespace Sdr;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use Sdr\Domain\BasketItemId;

class DoctrineBasketItemId extends GuidType
{
    public function getName()
    {
        return 'BasketItemId';
    }

    /**
     * @param BasketItemId     $value
     * @param AbstractPlatform $platform
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return (string)$value;
    }

    /**
     * @param mixed            $value
     * @param AbstractPlatform $platform
     * @return mixed|BasketId
     * @throws \Exception
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return BasketItemId::create($value);
    }
}
