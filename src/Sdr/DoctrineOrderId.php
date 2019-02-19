<?php

namespace Sdr;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use Sdr\Domain\OrderId;

class DoctrineOrderId extends GuidType
{
    public function getName()
    {
        return 'OrderId';
    }

    /**
     * @param OrderId  $value
     * @param AbstractPlatform $platform
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return (string) $value;
    }

    /**
     * @param mixed            $value
     * @param AbstractPlatform $platform
     * @return mixed|OrderId
     * @throws \Exception
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return OrderId::create($value);
    }
}
