<?php

namespace Sdr;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use Sdr\Domain\OrderItemId;

class DoctrineOrderItemId extends GuidType
{
    public function getName()
    {
        return 'OrderItemId';
    }

    /**
     * @param OrderItemId      $value
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
     * @return OrderId
     * @throws \Exception
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return OrderItemId::create($value);
    }
}
