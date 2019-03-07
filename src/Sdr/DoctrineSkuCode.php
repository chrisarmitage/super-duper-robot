<?php

namespace Sdr;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use Sdr\Domain\OrderId;
use Sdr\Domain\SkuCode;

class DoctrineSkuCode extends GuidType
{
    public function getName(): string
    {
        return 'SkuCode';
    }

    /**
     * @param SkuCode          $value
     * @param AbstractPlatform $platform
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return (string)$value;
    }

    /**
     * @param string           $value
     * @param AbstractPlatform $platform
     * @return SkuCode
     * @throws \Exception
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): SkuCode
    {
        return SkuCode::create($value);
    }
}
